<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\ProductRequest;

class AdminController extends Controller
{
    public function createProduct(){

        return view('admin.createproduct');
    }

    public function dashboardAdmin()
    {

        return view('admin.dashboard');
    }

    public function addProduct(ProductRequest $request){
        $validate = $request->validate([
            'image' => 'required|min:5|mimes:jpeg,jpg,png,gif',
        ]);
        $path = $request->file('image')->store('public/Images');
        $path = substr($path, strlen('public/'));

        Products::create([
            'name' => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'image' => $path,
            'price' => $request->price,
        ]);

        return redirect(route('createProduct'))->with('success', 'Produk berhasil ditambahkan');
    }
}
