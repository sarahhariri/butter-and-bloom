<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CakeOrder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
  public function index(Request $request)
{
    $filters = [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    $data = $request->validate([
        'status' => [
            'nullable',
            Rule::in(array_keys($filters)),
        ],
        'search' => ['nullable', 'string', 'max:100'],
    ]);

    $status = $data['status'] ?? null;
    $search = trim($data['search'] ?? '');

    $orders = CakeOrder::query()
        ->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        })
        ->when($search !== '', function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('customer_name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view(
        'admin.dashboard',
        compact('orders', 'filters', 'status', 'search')
    );
}
    public function show(CakeOrder $order)
{
    return view('admin.orders.show', compact('order'));
}

public function reference(CakeOrder $order)
{
    abort_unless($order->reference_image, 404);

    $disk = Storage::disk('local');

    abort_unless($disk->exists($order->reference_image), 404);

    return response()->file(
        $disk->path($order->reference_image),
        ['Cache-Control' => 'private, no-store']
    );
}

public function update(Request $request, CakeOrder $order)
{
    $data = $request->validate([
        'status' => [
            'required',
            Rule::in([
                'pending',
                'confirmed',
                'completed',
                'cancelled',
            ]),
        ],
        'final_price' => [
            'nullable',
            'numeric',
            'min:0',
            'max:99999999.99',
            'required_if:status,confirmed,completed',
        ],
    ]);

    $order->status = $data['status'];
    $order->final_price = $data['final_price'] ?? null;
    $order->save();

    return back()->with('success', 'Request updated successfully.');
}
}