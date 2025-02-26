@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Products</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>{{ $product->name }}</h5>
                            <p>${{ $product->price }}</p>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Buy Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
