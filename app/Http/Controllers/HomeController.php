<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): Factory|View|Application
    {
        $categories = Category::query()
            ->limit(6)
            ->get();

        $brands = Brand::query()
            ->limit(6)
            ->get();

        $products = Product::query()
            ->limit(6)
            ->get();

        return view('welcome', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
        ]);
    }
}