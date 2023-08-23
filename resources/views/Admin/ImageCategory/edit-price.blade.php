<h1>Edit Image Prices - {{ $category->type }}</h1>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('ImageCategory.update', $category) }}" method="POST">
    @csrf
    @foreach ($images as $image)
        <div class="form-group">
            <label for="price_{{ $image->id }}">{{ $image->name }}</label>
            <input type="number" name="price_{{ $image->id }}" id="price_{{ $image->id }}" value="{{ $image->price }}">
        </div>
    @endforeach

    <button type="submit">Update Prices</button>
</form>
