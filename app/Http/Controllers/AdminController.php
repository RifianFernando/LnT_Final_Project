<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\ProductRequest;

class AdminController extends Controller
{
    public function createProduct(){
        
        return view('admin.createProduct');
    }

    public function dashboardAdmin()
    {
        $products = Products::all();

        return view('admin.dashboard', compact('products'));
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

    public function deleteProduct($id){
        $product = Products::find($id);
        $product->destroy($id);

        return redirect(route('dashboardAdmin'))->with('success', 'Produk berhasil dihapus');
    }
        
}
