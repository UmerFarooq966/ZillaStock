
<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Zilla Stock</title>
    @include('Buyer.B-layouts.partials.lib')
</head>

<body>
@include('Buyer.B-layouts.partials.navbar')



<!-- Display the cart items -->

<div class="container">
    <h1><bold>Cart Items</bold></h1>

    <ul>
        @if ($cartItems->count() > 0)
        @foreach($cartItems as $cartItem)
            <div class="col-md-4 ">
                <a href="{{ route('showw', $cartItem->id) }}">
                    <div class="card mb-4 box-shadow    ">
                        <img class="card-img-top" src="/image/{{ $cartItem->image->image }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>{{ $cartItem->image->name }} - ${{ $cartItem->price }}</h5>
                                <div class="btn-group">
                                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" type="submit">Remove</button>
                                    </form>
                                </div>
                            </div>

                            <small class="text-muted">{{ $cartItem->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        @else
            <p>Your cart is empty.</p>
        @endif
    </ul>
</div>
<div class="text-center">
    <a href="{{ route('checkout.bro') }}" class="btn btn-primary">Proceed to Checkout</a>
</div>

</body>
</html>
