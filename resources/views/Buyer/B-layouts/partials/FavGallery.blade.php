<div class="container">
    <h1>My Favorite Images</h1>
    <hr>


        <div class="row">
            @foreach($favourites as $image)
                <div class="col-md-4">
                    <a href="{{ route('showw', $image->id) }}">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="/image/{{ $image->image }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>{{ $image->name }}</h5>
                                <div class="btn-group">
                                    @auth
                                        @if (Auth::check() && Auth::user()->favourites->contains('image_id', $image->id))
                                            <button class="like btn btn-danger float-right" data-image-id="{{ $image->id }}" type="button"><span class="fa fa-heart"></span> Unfavorite</button>
                                        @else
                                            <button class="like btn btn-default float-right" data-image-id="{{ $image->id }}" type="button"><span class="fa fa-heart"></span> Favorite</button>
                                        @endif
                                    @else
                                        <a class="like btn btn-default float-right" href="{{ route('login') }}" type="button"><span class="fa fa-heart"></span> Favorite</a>
                                    @endauth
                                </div>
                            </div>
                            <p class="card-text">{{ $image->description }}</p>
                            <small class="text-muted">{{ $image->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach



        </div>

</div>
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
                    location.reload();
                },
                error: function(response) {
                    console.log(response);
                }
            });

        });
    });
</script>
