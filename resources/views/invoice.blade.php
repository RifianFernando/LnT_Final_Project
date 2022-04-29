<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <title>{{ $title }}</title>
</head>
<body>
    <div class="container px-4 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-5">
                <h4 class="heading">Shopping Bag</h4>
            </div>
            <div class="col-7">
                <div class="row text-right">
                    <div class="col-4">
                        <h6 class="mt-2">Category</h6>
                    </div>
                    <div class="col-4">
                        <h6 class="mt-2">Quantity</h6>
                    </div>
                    <div class="col-4">
                        <h6 class="mt-2">Price</h6>
                    </div>
                </div>
            </div>
        </div>
        @php
            $total = 0;
            $i = 0;
        @endphp
        @foreach($cart as $cart)
            <div class="row d-flex justify-content-center border-top">
                <div class="col-5">
                    <div class="row d-flex">
                        <div class="book"> <img src="{{ asset('storage/'.$cart->image) }}" class="book-img"> </div>
                        <div class="my-auto flex-column d-flex pad-left">
                            <h6 class="mob-text">{{ $cart->name }}</h6>
                        </div>
                    </div>
                </div>
                <div class="my-auto col-7">
                    <div class="row text-right">    
                        <div class="col-4">
                            <p class="mob-text">{{ $cart->category }}</p>
                        </div>
                        <div class="col-4">
                            <div class="row d-flex justify-content-end px-3">
                                <p class="mb-0" id="cnt1">{{ $kuantitas[$i] }}</p>
                            </div>
                        </div>
                        <div class="col-4">
                            @php
                                $total_price = $cart->price;
                                $total += $total_price * $kuantitas[$i];
                                $i++;
                                $total_price_rupiah = "Rp" . number_format($total_price,2,',','.');
                            @endphp
                            <h6 class="mob-text">{{ $total_price_rupiah }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row justify-content-center">
            <div class="col-lg-12">
                @php
                    $id = Auth::user()->id;
                @endphp
                <form class="card" action="{{ route('makeInvoice', ['id'=>$id]) }}" method="POST">
                @csrf
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="coloumn px-2">
                                @error('shipping_address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group col-md-15"> <label class="form-control-label">Shipping Address</label> <input type="text" id="cname" name="shipping_address" placeholder="Johnny Dodol"> 
                                </div>

                                @error('postal_code')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group col-md-15"> <label class="form-control-label">Postal Code</label> <input type="text" id="cnum" name="postal_code" placeholder="065478"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-2">
                                @php
                                    $total_price_rupiah = "Rp" . number_format($total,2,',','.');
                                @endphp
                            <div class="row d-flex justify-content-between px-4" id="tax">
                                <p class="mb-1 text-left">Total</p>
                                <h6 class="mb-1 text-right">{{ $total_price_rupiah }}</h6>
                            </div> 
                            <a href="{{ route('cart') }}" class="btn btn-danger"><i class="fa fa-angle-left"></i> Back</a>
                            <button type="submit" class="btn-block btn-blue"> <span> <span id="checkout">Make Invoice</span> <span id="check-amt">{{ $total_price_rupiah }}</span> </span> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

        $('.radio-group .radio').click(function(){
        $('.radio').addClass('gray');
        $(this).removeClass('gray');
        });

        $('.plus-minus .plus').click(function(){
        var count = $(this).parent().prev().text();
        $(this).parent().prev().html(Number(count) + 1);
        });

        $('.plus-minus .minus').click(function(){
        var count = $(this).parent().prev().text();
        $(this).parent().prev().html(Number(count) - 1);
        });

        });
    </script>
</body>
</html>