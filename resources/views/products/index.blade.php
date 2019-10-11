@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($products as $product)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ $product->name }}</div>

                <div class="card-body">
                    {{ $product->description }}
                </div>
                <div class="card-footer">
                    <form action="cart/{{ $product->id }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Add to cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $products->links() }}
</div>
@endsection