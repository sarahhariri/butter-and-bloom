<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UnavailableDate;
use Illuminate\Http\Request;

class UnavailableDateController extends Controller
{
    public function index()
    {
        $dates = UnavailableDate::orderBy('date')
            ->paginate(15);

        return view('admin.unavailable-dates.index', compact('dates'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
                'unique:unavailable_dates,date',
            ],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        UnavailableDate::create($data);

        return back()->with(
            'success',
            'Date marked as unavailable.'
        );
    }

    public function destroy(UnavailableDate $unavailableDate)
{
    $unavailableDate->delete();

    return back()->with(
        'success',
        'Date is available again.'
    );
}
}
