<?php

namespace App\Http\Controllers;

use App\Models\Cake;

class CakeCollectionController extends Controller
{
    public function index()
    {
        $cakes = Cake::where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view('cakes', compact('cakes'));
    }
}