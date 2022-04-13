<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createProduct()
    {
        return view('admin.createproduct');
    }

    public function dashboardAdmin()
    {
        return view('admin.dashboard');
    }

    public function addProduct(Request $request){
        $request->validate([
            'name' => ['required', 'min:3', 'string', 'max:40'],
            'category' => ['required', 'string', 'max:255'],
            'quantity'=>['required', 'numeric'],
            'image ' => ['required', 'image:jpg, jpef, png'],
            'price' => ['required', 'numeric'],
        ]);

        $path = $request->file('image')->store('public/Images');
        $path = substr($path, strlen('public/'));

        $product = Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'image' => $path,
            'price' => $request->price,
        ]);

        $product->category()->attach($request->category);
        return redirect(route('home'));
    }
}
