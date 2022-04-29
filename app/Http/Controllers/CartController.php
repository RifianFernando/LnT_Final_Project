<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\QuantityProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\invoiceRequest;
use App\Models\invoiceUser;
use App\Models\TotalProduct;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $user = Auth::user()->id;
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
            return view('cart', ['title' => 'Cart']); 
        };
        
        $Looping_cart = count($kuantitas);
        return view('cart', ['title' => 'Cart', 'cart' => $cart, 'kuantitas' => $kuantitas, 'Looping_cart' => $Looping_cart]);
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
        $stock_table = Products::find($id)->quantity;
        if($stock_table == 0){
            return back()->with(['errorId'=>$id, 'error'=>'Maaf, stok barang sudah habis']);
        }
        else{
            if($quantity_table == null){
                TotalProduct::create([
                    'users_id' => $user,
                    'products_id' => $id_barang,
                ]);
                $stock_table = $stock_table - 1;
                Products::find($id)->update([
                    'quantity' => $stock_table,
                ]);
            }else{
                $quantity_table->update([
                    'quantity' => $quantity_table->quantity + 1
                ]);
                $stock_table = $stock_table - 1;
                Products::find($id)->update([
                    'quantity' => $stock_table,
                ]);
            }

            return redirect(route('home'));
        }
    }
    

    public function addToCartOnCart($id){
        $user = Auth::user()->id;
        $id_barang  = Products::find($id)->id;
        $quantity_table = TotalProduct::where('users_id', $user)->where('products_id', $id_barang)->first();
        $stock_table = Products::find($id)->quantity;
        if($stock_table == 0){
            return back()->with(['errorId'=>$id, 'error'=>'Maaf, stok barang sudah habis']);
        }
        else{
            if($quantity_table == null){
                TotalProduct::create([
                    'users_id' => $user,
                    'products_id' => $id_barang,
                ]);
                $stock_table = $stock_table - 1;
                Products::find($id)->update([
                    'quantity' => $stock_table,
                ]);
            }else{
                $quantity_table->update([
                    'quantity' => $quantity_table->quantity + 1
                ]);
                $stock_table = $stock_table - 1;
                Products::find($id)->update([
                    'quantity' => $stock_table,
                ]);
            }

            return redirect(route('cart'));
        }
    }

    public function incrementOnCart($id){
        $user = Auth::user()->id;
        $id_barang  = Products::find($id)->id;
        $quantity_table = TotalProduct::where('users_id', $user)->where('products_id', $id_barang)->first();
        $stock_table = Products::find($id)->quantity;
        if($quantity_table->quantity == 1){
            return back()->with(['errorId'=>$id, 'error'=>'Maaf, stok tidak dapat dikurangi silahkan hapus barang terlebih dahulu']);
        }
        else{
            $quantity_table->update([
                'quantity' => $quantity_table->quantity - 1
            ]);
            $stock_table = $stock_table + 1;
            Products::find($id)->update([
                'quantity' => $stock_table,
            ]);
            return redirect(route('cart'));
        }
    
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
    /**
     * delete barang di cart
     *
     * @return response()
     */
    public function remove(Request $request, $id)
    {
        $stock_table = Products::find($id)->quantity;
        $last_add_Stock = TotalProduct::where('products_id', $id)->first();
        $stock_table = $stock_table + $last_add_Stock->quantity;
        Products::find($id)->update([
            'quantity' => $stock_table,
        ]);
        $id_product = $request->id;
        $user = Auth::user()->id;
        $cart = TotalProduct::where('users_id', $user)->where('products_id', $id_product)->first();
        $cart->delete();
        
        return redirect(route('cart'))->with('success', 'Product removed successfully');
    }

    public function invoicePage(){
        $user = Auth::user()->id;
        $check_cart = TotalProduct::where('users_id', $user)->first();

        if(!$check_cart){
            return redirect(route('cart'))->with('error', 'Cart is empty');
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
        $Looping_cart = count($kuantitas);

        return view('invoice', ['title' => 'Invoice', 'cart' => $cart, 'kuantitas' => $kuantitas, 'Looping_cart' => $Looping_cart]);
    }

    public function makeInvoice(invoiceRequest $request, $id){
        $quantity = TotalProduct::where('users_id', $id)->get('products_id');
        for($i = 0; $i < count($quantity); $i++){
            $detail_product_user = $quantity[$i]->products_id;
            $cart[$i] = Products::find($detail_product_user);
        }
        $product_quantity = TotalProduct::where('users_id', $id)->get();
        for($i = 0; $i < count($product_quantity); $i++){
            a:
            $projectCount = rand(1000, 9999);
            $rand_word_invoice = 'INV-'. str_pad($projectCount, 5, '0', STR_PAD_LEFT) .'-'.date('d').date('m').date('Y');
            $check_same_invoice = invoiceUser::where('invoice', $rand_word_invoice)->first();

            if($check_same_invoice == null){
                $invoice = $rand_word_invoice;
            }else{
                goto a;
            }
            $total = 0;
            $kuantitas[$i] = $product_quantity[$i]->quantity;
            $total += $cart[$i]->price * $kuantitas[$i];
            
            invoiceUser::create([
                'users_id' => $id,
                'invoice' => $invoice,
                'product_category' => $cart[$i]->category,
                'product_name' => $cart[$i]->name,
                'product_quantity' => $kuantitas[$i],
                'shipping_address' => $request->shipping_address,
                'postal_code' => $request->postal_code,
                'total_price' => $total,
            ]);
        }
        TotalProduct::where('users_id', $id)->delete();

        return redirect(route('cart'))->with('success', 'Invoice has been created');
    }

    public function searchProduct(Request $request)
    {
        $search = $request->search;
        $products = Products::where('name', 'like', '%'.$search.'%')->get();
        return view('products', ['title' => 'Home', 'products' => $products]);
    }
}
