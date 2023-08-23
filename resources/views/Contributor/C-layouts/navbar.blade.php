

<!-- Navigation barr -->
<nav class=" navbar-inverse navbar-expand-md py-3 bg-dark navbar-dark sticky-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">ZillaStock</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            @auth
            <li><a href="../Buyer/Favourites" target="_blank">Favourite</a></li>
            <li><a href="../Editor/index " target="_blank">Image Editor</a></li>
            @endauth
        </ul>
        @auth
            <div class="navbar">

                <ul class="navbar-nav ms-auto ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../Buyer/B-dashboard"> Dashboard</a></li>
                        <li><a class="dropdown-item" href="#">Payments</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" >Logout</a></li>
                    </ul>
                </ul>
            </div>

        @endauth

        @guest
            <div class="text-end">
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-warning">Sign-up</a>
            </div>
        @endguest
    </div>
</nav>
