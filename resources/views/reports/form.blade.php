
@include('Buyer.B-layouts.partials.navbar')
@include('Buyer.B-layouts.index-master-for-Buyimage')

@auth()
<div class="bg-light p-5 rounded">
    <div class="card">
        <div class="container">
<form action="{{ route('report.store', $image) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="reason">Reason for Reporting:</label>
        <textarea name="reason" id="reason" rows="4" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Report Image</button>
</form>
        </div>
        </div>
        </div>
@endauth
@guest()
    <h1>Login to report</h1>
    <a class="like btn btn-default" href="{{ route('login') }}" type="button"><span class="fa fa-heart"></span> Favorite</a>
@endguest
