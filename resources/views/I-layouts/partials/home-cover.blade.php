<!-- Search barr -->
<div class="bbbootstrap" style="  background-image: url('/images/{{$image->image}}');">
    <div class="top">
        <div class="headings bx-font-size">
            <h1>Stunning images &amp; royalty free stock</h1>
            @auth()
            @if (auth()->user()->role == 'admin')

            <form action="{{ route('admin.uploadImage') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="input-sm" type="file" name="image" accept="image/*">
                <button class="btn btn-dark" type="submit">Upload Image</button>
            </form>
            @endif
            @endauth
            <!-- <h2>Over 2.7 million+ high quality stock images shared by our talented community.</h2> -->
        </div>
    </div>
    <div class="container">
        <form action="{{route('search')}}" method="GET">

            <span role="status" aria-live="polite" class="ui-helper-hidden-accessible">

            </span>
            <input type="text" id="Form_Search" name="q" value="" placeholder="Search for your best result in our community" role="searchbox" class="InputBox " autocomplete="on" required>
            <input type="submit" id="Form_Go" class="Button" value="GO">


        </form>
    </div>
</div>
<!-- -->
