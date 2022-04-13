<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

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

    public function addbarang(Request $request)
    {
        Products::create([
            'name' => $request -> title,
            'price' => $request -> price,
            'description' => $request -> brand,
            'image' => $request -> image
        ]);
        // $imageName = time().'.'.$request->image->extension();
        $imageName = $request->image->getClientOriginalName();
        $request->image->storeAs('images', $imageName);
        return redirect('/');
    }


    /**
     * adding barang dari tombol home ke halaman cart
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = Products::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // spesifikasi barang di cart
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        // taro ke barang
        session()->put('cart', $cart);
        return redirect()->back();
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
}
