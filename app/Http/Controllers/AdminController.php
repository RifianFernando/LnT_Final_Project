<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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

    public function addProduct(ProductRequest $request){
        $path = $request->file('image')->store('public/Images');
        $path = substr($path, strlen('public/'));
        
        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'image' => $path,
            'price' => $request->price,
        ]);

        return redirect(route('home'))->with('success', 'Produk berhasil ditambahkan');
    }
}
