
@extends('layouts.layouthome')
@section('container')
<div class="container-product">
    <div class="row justify-content-center">
        <div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="/products">
                        <div class="input-group mb-3">
                            <input type= "text" class="form-control" placeholder="search.." name="search" value="{{ request('search') }}">
                            <button class="btn btn-danger" type="submit">Search</button>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        
        @if($products->count() == 0)
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">No Products Found</h5>
                </div>
            </div>
        </div>
        @endif
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
              <img class="card-img-top"  src="{{ asset('storage/'.$product->image) }}" alt="profile Pic" height="380" width="200">
              <div class="card-body">
                <p class="card-text">{{ $product->name }}</p>
                <p class="card-text">{{ $product->category }}</p>
                <p class="card-text">{{ $product->price }}$</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a></p>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
          @endforeach

      </div>
    </div>
    


  </div>
@endsection
