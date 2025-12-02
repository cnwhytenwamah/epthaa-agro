<?php

namespace App\Http\Controllers\FrontPages;

use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->take(8)
            ->get();
        
        $services = Service::where('is_active', true)->take(4)->get();
        $testimonials = Testimonial::where('is_featured', true)->take(6)->get();

        return view('home', compact('featuredProducts', 'services', 'testimonials'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}