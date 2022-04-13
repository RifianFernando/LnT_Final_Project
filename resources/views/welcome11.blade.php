<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        @if(Auth::user()->is_admin == true)
                            <a href="{{ route('dashboardAdmin') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                        @else  
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                
                    @extends('layouts.layouthome')
                    @section('container')
                    <div class="album py-5 bg-light">
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
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                <img class="card-img-top"   alt="profile Pic" height="380" width="200">
                                <div class="card-body">
                                    <p class="card-text">a56</p>
                                    <p class="card-text">Samsung</p>
                                    <p class="card-text">Rp 5000</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <p class="btn-holder"><a  class="btn btn-warning btn-block text-center" role="button">Add to cart</a></p>
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endsection

            </div>
        </div>
    </body>
</html>
