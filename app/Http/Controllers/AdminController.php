<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\TotalProduct;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function home()
    {
        $products = Products::all();
        return view('products', ['title' => 'Home', 'products' => $products]);
    }
    
    public function createProduct(){
        
        return view('admin.createProduct');
    }

    public function dashboardAdmin()
    {
        $products = Products::all();

        return view('admin.dashboard', compact('products'));
    }

    public function addProduct(ProductRequest $request){
        $request->validate([
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
     
    public function updateProduct($id){
        $product = Products::find($id);
        
        return view('admin.editProduct', ['product' => $product]);
    }

    public function update(ProductRequest $request, $id){
        $request->validate([
            'image' => 'required|min:5|mimes:jpeg,jpg,png,gif',
        ]);
        if($request->hasFile('image')){
            $img_update = Products::find($id)->image;
            Storage::delete($img_update);
            // 2. possibility
            unlink(storage_path('app/public/'.$img_update));
            $path = $request->file('image')->store('public/Images');
            $path = substr($path, strlen('public/'));
            $product = Products::find($id);
            $product->update([
                'name' => $request->name,
                'category' => $request->category,
                'quantity' => $request->quantity,
                'image' => $path,
                'price' => $request->price,
            ]);
        }

        return redirect(route('createProduct'))->with('success', 'Produk berhasil diupdate');
    }
}
