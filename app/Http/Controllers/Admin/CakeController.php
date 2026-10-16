<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cake;
use App\Models\Flavour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $cakes = Cake::with('flavour')
    ->orderBy('sort_order')
        ->orderByDesc('id')
        ->paginate(12);

    return view('admin.cakes.index', compact('cakes'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $flavours = Flavour::orderBy('sort_order')
        ->orderBy('name')
        ->get();

    return view('admin.cakes.create', compact('flavours'));
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $data = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'tagline' => ['required', 'string', 'max:100'],
        'description' => ['required', 'string', 'max:1000'],
        'image' => [
            'required',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:5120',
        ],
        'sort_order' => ['required', 'integer', 'min:0', 'max:100000'],
        'is_active' => ['required', 'boolean'],
        'is_featured' => ['required', 'boolean'],
    ]);

    $data['image'] = $request->file('image')
        ->store('cakes', 'public');

    Cake::create($data);

    return redirect()
        ->route('admin.cakes.index')
        ->with('success', 'Cake added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Cake $cake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(Cake $cake)
{
     $flavours = Flavour::orderBy('sort_order')
        ->orderBy('name')
        ->get();

    return view('admin.cakes.edit', compact('cake', 'flavours'));
}

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Cake $cake)
{
    $data = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'tagline' => ['required', 'string', 'max:100'],
        'description' => ['required', 'string', 'max:1000'],
        'image' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:5120',
        ],
        'sort_order' => ['required', 'integer', 'min:0', 'max:100000'],
        'is_active' => ['required', 'boolean'],
        'is_featured' => ['required', 'boolean'],
        'flavour_id' => [
    'required',
    'integer',
    Rule::exists('flavours', 'id'),
],
    ]);

    $oldImage = $cake->image;
    $newImage = null;

    unset($data['image']);

    if ($request->hasFile('image')) {
        $newImage = $request->file('image')
            ->store('cakes', 'public');

        $data['image'] = $newImage;
    }

    try {
        $cake->update($data);
    } catch (\Throwable $exception) {
        if ($newImage) {
            Storage::disk('public')->delete($newImage);
        }

        throw $exception;
    }

    if ($newImage && $oldImage !== $newImage) {
        Storage::disk('public')->delete($oldImage);
    }

    return redirect()
        ->route('admin.cakes.index')
        ->with('success', 'Cake updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Cake $cake)
{
    $image = $cake->image;

    $cake->delete();

    if ($image) {
        Storage::disk('public')->delete($image);
    }

    return redirect()
        ->route('admin.cakes.index')
        ->with('success', 'Cake deleted successfully.');
}
}
