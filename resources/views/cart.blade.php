@extends('layouts.layouthome')
@section('container')

<br/>
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
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
                            </div>
                        </div>
                    </td>
                    @php
                        $angka = $cart->price;
                        $hasil_rupiah = "Rp" . number_format($angka,2,',','.');
                    @endphp
                    <td data-th="Price">{{ $hasil_rupiah }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $kuantitas[$i] }}" class="form-control quantity update-cart" />
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
            @if (isset($cart))
                <td colspan="5" class="text-right">
                    <a href="" class="btn btn-danger"><i class="fa fa-angle-right"></i> Checkout</a>
                </td>
            @else
                <td colspan="5" class="text-right">
                    <a href="" class="btn btn-danger"><i class="fa fa-angle-right"></i>Checkin</a>
                </td>
            @endif
        </tr>
    </tfoot>
</table>
<script type="text/javascript">

    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

</script>
@endsection
