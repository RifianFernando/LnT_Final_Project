@extends('layouts.layouthome')
@section('container')

<br/>
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
    @endif

</div>

<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        <div class="container">
            <div class="row">
                
            </div>
        </div>
        
        <br/>
        @php 
            $total = 0;
            $i = 0;
            $total_all = 0;
        @endphp
        @isset($cart)
            @foreach($cart as $cart)
                <tr data-id="{{ $loop->iteration }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ asset('storage/'.$cart->image) }}" width="100" height="100" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $cart->name }}</h4>
                                @if($error = Session::get('errorId') == $cart->id)
                                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    @php
                        $angka = $cart->price;
                        $hasil_rupiah = "Rp" . number_format($angka,2,',','.');
                    @endphp
                    <td data-th="Price">{{ $hasil_rupiah }}</td>
                    <td data-th="Quantity">
                        <form action="{{ route('addToCartOnCart', ['id'=>$cart->id]) }}" method="get">
                            @csrf
                              <button type="submit" class="tanda-tambah">
                                +
                              </button>
                        </form>
                        <input type="number" disabled value="{{ $kuantitas[$i] }}" class="form-control quantity update-cart" />
                        <form action="{{ route('incrementOnCart', ['id'=>$cart->id]) }}" method="get">
                            @csrf
                              <button type="submit" class="tanda-tambah">
                                -
                              </button>
                        </form>
                    </td>
                    <td data-th="Subtotal" class="text-center">
                        @php
                            $subtotal = $angka * $kuantitas[$i];
                            $subtotal_rupiah = "Rp" . number_format($subtotal,2,',','.');
                            $total_all = $total_all + $subtotal;
                        @endphp
                        {{ $subtotal_rupiah }}
                    </td>
                    <form action="{{ route('remove.from.cart', $cart->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <td class="actions" data-th="{{ $loop->iteration }}">
                            <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </form>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        @endisset
    </tbody>
    <tfoot>
        <tr>
            @php
                $total_all_rupiah = "Rp" . number_format($total_all,2,',','.');
            @endphp
            <td colspan="5" class="text-right"><h3><strong>Total {{ $total_all_rupiah }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ route('invoicePage', ) }}" class="btn btn-danger"><i class="fa fa-angle-right"></i> Checkout</a>
            </td>
        </tr>
    </tfoot>
</table>
@endsection
