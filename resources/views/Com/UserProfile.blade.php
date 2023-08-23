<!DOCTYPE html>
<html>

<head>

    @include('Contributor/C-layouts.lib')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-mjxOxVzG0eMfaRaQ/XShGbR0+18hgnPgsyhAtN74jj77wq8rILFW5M5AKZb5aHSpzCJW8dNOgQ2tP5Lw/pEuHw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-yX4A4hJUifC6DfVBUUtuN+zhQndQNEzJZBto+7fzX9gOoz7PUJm6VK+H7ysLgL50uv+2rvZewoUDjjfA+1omzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-yX4A4hJUifC6DfVBUUtuN+zhQndQNEzJZBto+7fzX9gOoz7PUJm6VK+H7ysLgL50uv+2rvZewoUDjjfA+1omzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Bootstrap CSS for Model view -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
<!-- Navigation barr -->
@include('Contributor/C-layouts.navbar')
<!-- //Navigation barr -->


<body>
<main class="page landing-page">
    <section class="portfolio-block block-intro">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    @if ($Profilee->avatar)

                        <img src="/images/avatars/{{ $Profilee->avatar }}" class="rounded-circle img-thumbnail" alt="avatar">
                    @else
                        <img src="/images/avatars/placeholder.jpg"  alt="placeholder" class="rounded-circle img-thumbnail" >
                    @endif
                </div>
                <div class="col-md-9">
                    <h1 class="mb-4">{{ $Profilee->name }}</h1>
                    <p>Hello! I am <strong>{{ $Profilee->name }}</strong>.<br>I work as an interface and front-end developer. I have a passion for pixel-perfect, minimal, and easy-to-use interfaces.</p>
                    <div class="social-icons">
                        <a href="https://www.instagram.com/{{ $Profilee->instagram }}" target="_blank"><i class="i  bi-instagram" style="font-size: 180%;"></i></a>
                        <a href="{{ $Profilee->facebook }}" target="_blank"><i class="bi bi-facebook"  style="font-size: 180%;"></i></a>
                        <a href="https://twitter.com/{{ $Profilee->twitter }}" target="_blank"><i class="bi bi-twitter"   style="font-size: 180%;"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="portfolio-block photography">
        <div class="container">
            <div class="row">

                @foreach($images as $image)


                @if(auth()->user()->role == 'admin')
                        <div class="col-md-2">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="/image/{{ $image->image }}" >
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('showw', $image->id) }}">
                                            <h5>{{ $image->name }}</h5>
                                        </a>
                                        <div class="btn-group">
                                            @if ($image->state == 1)
                                                <button class="like btn btn-success float-right" data-image-id="{{ $image->id }}" type="button" disabled><span class="fa fa-heart"></span> Approved</button>
                                            @elseif($image->state == 2)
                                                <button class="like btn btn-danger float-right" data-image-id="{{ $image->id }}" type="button" data-toggle="collapse" data-target="#rejectionCard{{ $image->id }}"><span class="fa fa-heart"></span> Rejected</button>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="card-text">{{ $image->description }}</p>
                                    <small class="text-muted">{{ $image->created_at->diffForHumans() }}</small>
                                </div>
                                @if ($image->state == 2 && isset($image->rejection_reason))
                                    <div id="rejectionCard{{ $image->id }}" class="collapse">
                                        <div class="card-footer">
                                            <p>Rejection Reason: {{ $image->rejection_reason }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @else
                            <div class="col-md-4 item zoom-on-hover">

                                <a href="I-layouts/show/{{$image->id}}">
                                    <img class="img-fluid mb-4" src="/image/{{ $image->image }}"  alt="{{ $image->title }}" type="button">

                                </a>


                            </div>

                    @endif

                        @endforeach


            </div>
        </div>
    </section>
</main>
<footer class="page-footer">
    <div class="container">
        <p>Copyright &copy; 2023
            <a href="#">Zilla Stock</a>. All rights reserved.
        </p>
    </div>
</footer>
<!-- Required JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
<!-- Bootstrap JS For Model view -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    //javascript
    <a href="javascript:history.back()" class="btn btn-default">Back</a>

</script>
</body>

</html>
