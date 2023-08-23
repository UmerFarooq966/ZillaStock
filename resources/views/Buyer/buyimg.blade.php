<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Zilla Stock</title>

</head>

<body>
@include('Buyer.B-layouts.partials.navbar')
@include('Buyer.B-layouts.index-master-for-Buyimage')
    <div class="bg-light p-5 rounded">
<div class="card">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="preview">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1">
                                <img src="/image/{{ $image->image }}" alt="image" class="img-fluid" width=90%" height="auto">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="details">

                        <h3 class="product-title">{{ $image->name }}</h3>

                        <p class="product-description">Description: {{ $image->detail }}.</p>

                        <ul class="preview-thumbnail nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Com.show', $image->userid) }}">
                                    <img src="/images/avatars/{{ $user->avatar ? $user->avatar : 'placeholder.jpg' }}" alt="profile-pic" class="img-thumbnail" width="20%" height="auto">
                                </a>
                            </li>
                        </ul>
                        <a class="nav-link" href="{{ route('Com.show', $image->userid) }}">
                        <p class="Artist-description">Artist name: {{ $user->name }}</p>
                        </a>
                        <h4 class="price">current price: <span>${{ $image->price }}</span></h4>

                        <div class="action">


                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                <input type="number" name="quantity" value="1" min="1" hidden>
                                <button class="add-to-cart btn btn-default" type="submit">Add to Cart</button>
                            </form>
                            @if (Session::has('message'))
                                <div class="alert alert-success">
                                    {{ Session::get('message') }}
                                </div>
                            @endif


                        @auth
                                @if (Auth::check() && Auth::user()->favourites->contains('image_id', $image->id))
                                    <button class="like btn btn-danger" data-image-id="{{ $image->id }}" type="button"><span class="fa fa-heart"></span> Unfavorite</button>
                                @else
                                    <button class="like btn btn-default" data-image-id="{{ $image->id }}" type="button"><span class="fa fa-heart"></span> Favorite</button>
                                @endif
                            @else
                                <a class="like btn btn-default" href="{{ route('login') }}" type="button"><span class="fa fa-heart"></span> Favorite</a>
                            @endauth


                            <a class="add-to-editor btn btn-dark" href="/Editor/index" type="button">Open Image in editor</a>
                        </div>
                        <div class="report-button text-right">
                            <a class="btn btn-danger" href="{{ route('report.form', $image->id ) }}" type="button">Report</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
@if(isset($images))
    <div class="alert alert-success">

        <p>Related Images</p>

    </div>
@endif
@include('I-layouts.partials.gallery')
<script>
    $(document).ready(function() {
        $('.like').click(function(e) {
            e.preventDefault();
            var imageId = $(this).data('image-id');
            var isFavorited = $(this).hasClass('btn-danger');
            var url = isFavorited ? '{{ route("Buyer.removeFromFavorites", ":id") }}'.replace(':id', imageId) : '{{ route("Buyer.addToFavorites") }}';

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    _token: '{{ csrf_token() }}',
                    image_id: imageId
                },
                success: function(response) {
                    if (isFavorited) {
                        $('.like[data-image-id="' + imageId + '"]').removeClass('btn-danger').html('<span class="fa fa-heart"></span> Favorite');
                    } else {
                        $('.like[data-image-id="' + imageId + '"]').addClass('btn-danger').html('<span class="fa fa-heart"></span> Unfavorite');
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.add-to-cart').on('click', function() {
            window.location.href = '{{ route('cart.add') }}';
        });
    });

</script>

</body>
</html>
