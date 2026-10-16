<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $faqs = Faq::orderBy('sort_order')
        ->orderBy('id')
        ->paginate(15);

    return view('admin.faqs.index', compact('faqs'));
}

    /**
     * Show the form for creating a new resource.
     */
  public function create()
{
    return view('admin.faqs.create');
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $data = $request->validate([
        'question' => ['required', 'string', 'max:255'],
        'answer' => ['required', 'string', 'max:3000'],
        'sort_order' => ['required', 'integer', 'min:0', 'max:100000'],
        'is_active' => ['required', 'boolean'],
    ]);

    Faq::create($data);

    return redirect()
        ->route('admin.faqs.index')
        ->with('success', 'Question added successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

 public function edit(Faq $faq)
{
    return view('admin.faqs.edit', compact('faq'));
}

public function update(Request $request, Faq $faq)
{
    $data = $request->validate([
        'question' => ['required', 'string', 'max:255'],
        'answer' => ['required', 'string', 'max:3000'],
        'sort_order' => ['required', 'integer', 'min:0', 'max:100000'],
        'is_active' => ['required', 'boolean'],
    ]);

    $faq->update($data);

    return redirect()
        ->route('admin.faqs.index')
        ->with('success', 'Question updated successfully.');
}
public function destroy(Faq $faq)
{
    $faq->delete();

    return redirect()
        ->route('admin.faqs.index')
        ->with('success', 'Question deleted successfully.');
}
}
