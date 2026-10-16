<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flavour;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FlavourController extends Controller
{
    public function index()
    {
        $flavours = Flavour::orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.flavours.index', compact('flavours'));
    }

    public function edit(Flavour $flavour)
{
    return view('admin.flavours.edit', compact('flavour'));
}

public function update(Request $request, Flavour $flavour)
{
    $data = $request->validate([
        'name' => [
            'required',
            'string',
            'max:100',
            Rule::unique('flavours', 'name')->ignore($flavour->id),
        ],
        'sort_order' => [
            'required',
            'integer',
            'min:0',
            'max:100000',
        ],
        'is_active' => ['required', 'boolean'],
    ]);

    $flavour->update($data);

    return redirect()
        ->route('admin.flavours.index')
        ->with('success', 'Flavour updated successfully.');
}

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:flavours,name',
            ],
            'sort_order' => [
                'required',
                'integer',
                'min:0',
                'max:100000',
            ],
            'is_active' => ['required', 'boolean'],
        ]);

        Flavour::create($data);

        return back()->with('success', 'Flavour added successfully.');
    }

    public function destroy(Flavour $flavour)
{
    if (\App\Models\Cake::where('flavour_id', $flavour->id)->exists()) {
        return back()->with(
            'error',
            'This flavour is assigned to a cake. Hide it or change the cake flavour first.'
        );
    }

    $flavour->delete();

    return redirect()
        ->route('admin.flavours.index')
        ->with('success', 'Flavour deleted successfully.');
}
}