<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home(){

        $featuredProducts = Product::where("is_featured", true)->take(4)->get();

        $newProducts = Product::where("is_new", true)->take(4)->get();

        return view('home',["featuredProducts" => $featuredProducts, "newProducts" => $newProducts]);
    }
    public function index(Request $request){
        $query = Product::query();
        if($request->filled('category')){
            $query->where('category', $request->category);
        }
        if($request->filled('brand')){
            $query->where('brand', $request->brand);
        
        }
        if($request->filled('category')){
            $query->where('category', $request->category);
        }
        $products = $query->latest()->paginate(6);
        $categories = Product::distinct()->pluck('category');
        $brands = Product::distinct()->whereNotNull('brand')->pluck('brand');

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'filters' => $request->only(['category', 'brand', 'search']),
        ]);
    }

    public function show(string $slug) {
        $product = Product::where("slug", $slug)->firstOrFail();
        $relatedProducts = Product::where('category', $product->category)->where('id', "!=", $product->id)->take(4)->get();

        return view("products.product-show", ["product" => $product, "relatedProducts" => $relatedProducts]);
    }
}
