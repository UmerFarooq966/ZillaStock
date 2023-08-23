<!-- Gallery -->



<div class="container-fluid">



    @if(isset($message))
    <div class="alert alert-success">

            <p>{{ $message }}</p>

    </div>
    @else


    <div class="col-md-12 shadow-3-strong rounded mb-9">
        <div class="row">
            <hr>

            <div class="gal">


                @foreach ($images as $image)

                        <a href="{{ route('showw', $image->id) }}">

                    <img class="watermark" src="/image/{{ $image->image }}" alt="image" type="button">

                        </a>
                @endforeach

            </div>

        </div>
    </div>
    @endif

</div>
