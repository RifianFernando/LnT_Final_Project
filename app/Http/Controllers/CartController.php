<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\QuantityProduct;
use App\Http\Controllers\Controller;
use App\Models\TotalProduct;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        return view('cart', ['title' => 'Cart']);
    }

    //addproduct
    public function addbarangview()
    {
        return view('createproduct', ['title' => 'Create']);
    }

    /**
     * adding barang dari tombol home ke halaman cart
     *
     * @return response()
     */
    public function addToCart($id){
        $user = Auth::user()->id;
        $id_barang  = Products::find($id)->id;
        $quantity_table = TotalProduct::where('users_id', $user)->where('products_id', $id_barang)->first();
        if($quantity_table == null){
            TotalProduct::create([
                'users_id' => $user,
                'products_id' => $id_barang,
                'quantity' => 1
            ]);
        }else{
            $quantity_table->update([
                'quantity' => $quantity_table->quantity + 1
            ]); 
        }
        $quantity = TotalProduct::where('users_id', $user)->get('products_id');
        for($i = 0; $i < count($quantity); $i++){
            $detail_product_user = $quantity[$i]->products_id;
            $cart[$i] = Products::find($detail_product_user);
        }
        $product_quantity = TotalProduct::where('users_id', $user)->get();
        for($i = 0; $i < count($product_quantity); $i++){
            $kuantitas[$i] = $product_quantity[$i]->quantity;
        }
        if(empty($kuantitas) || empty($cart)){
            return redirect(route('home')); 
        };
        return redirect(route('home'));
    }

    /**
     * update barang ke cart
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
//delete product
    public function delete($id)
    {
        $products = Products::all();
        Products::destroy($id);
        return view('deleteproduct', compact('products'), [
            "title" => 'delete'
        ]);
    }

    /**
     * delete di keranjang
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function searchProduct(Request $request)
    {
        $search = $request->search;
        $products = Products::where('name', 'like', '%'.$search.'%')->get();
        //return view('search', ['products' => $products, 'title' => 'Search']);
        return view('products', ['title' => 'Home', 'products' => $products]);
    }
}
