<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\Faq;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCakes = Cake::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->take(3)
            ->get();

        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('home', compact('featuredCakes', 'faqs'));
    }
}
