<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\CakeOrder;
use App\Models\Flavour;
use App\Models\UnavailableDate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CakeOrderController extends Controller
{

    public function create(Request $request)
    {
        $request->validate([
            'cake' => ['nullable', 'integer', 'min:1'],
        ]);

        $selectedCake = null;

        if ($request->filled('cake')) {
            $selectedCake = Cake::where('is_active', true)
                ->findOrFail($request->query('cake'));
        }

        $unavailableDates = UnavailableDate::whereDate('date', '>=', today())
            ->get()
            ->map(fn($day) => $day->date->format('Y-m-d'))
            ->values();

        $flavours = Flavour::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'custom-order',
            compact('unavailableDates', 'selectedCake', 'flavours')
        );
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30'],
            'flavour' => [
                'required',
                'string',
                Rule::exists('flavours', 'name')
                    ->where('is_active', true),
            ],

            'cake_id' => [
                'nullable',
                'integer',
                Rule::exists('cakes', 'id')
                    ->where('is_active', true),
            ],
            'guest_count' => ['required', 'integer', 'min:1'],
            'pickup_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
                Rule::notIn(
                    \App\Models\UnavailableDate::pluck('date')
                        ->map(fn($date) => $date->format('Y-m-d'))
                        ->all()
                ),
            ],
            'cake_message' => ['nullable', 'string', 'max:60'],
            'reference_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'pickup_date.not_in' =>
            'This pickup date is unavailable. Please choose another day.',
        ]);


        $selectedCake = !empty($data['cake_id'])
            ? Cake::findOrFail($data['cake_id'])
            : null;

        $data['cake_name'] = $selectedCake?->name;
        if ($request->hasFile('reference_image')) {
            $data['reference_image'] = $request
                ->file('reference_image')
                ->store('cake-references', 'local');
        }

        CakeOrder::create($data);

        return redirect()
            ->route('orders.create')
            ->with(
                'success',
                'Your cake request has been received! We’ll contact you to confirm availability and the final price.'
            );
    }
}
