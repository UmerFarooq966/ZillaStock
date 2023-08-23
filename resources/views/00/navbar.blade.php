

<!-- Navigation barr -->
<nav class=" navbar-inverse navbar-expand-md py-3 bg-dark navbar-dark sticky-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">ZillaStock</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
            @auth
                <li class="{{ Request::is('Buyer/Favourites') ? 'active' : '' }}"><a href="{{route('Buyer.showFavorites')}}" >Favourite</a></li>
                <li class="{{ Request::is('Editor/editor') ? 'active' : '' }}"><a href="{{route('editor.home')}} " target="_blank">Image Editor</a></li>
            @endauth
        </ul>
        @auth


            <div class="navbar">
                <ul class="navbar-nav ms-auto ">
                    <!-- Cart Icon -->


                        <a class="nav-link" href="{{ route('cart.show') }}">
                            <i class="bi bi-cart-fill" style="font-size: 24px;"></i>
                        </a>

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <li><a class="dropdown-item" href="{{ route('Com.index') }}">Profile</a></li>

                        @if (auth()->user()->role == 'user')
                            <li><a class="dropdown-item" href="{{route('purchased-images')}}">Purchased Images</a></li>
                            <li><a class="dropdown-item" href="../Contributor/C-dashboard " target="_blank">Contributor Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('billing.edit')}}">Billing</a></li>
                        @elseif((auth()->user()->role == 'admin'))
                            <li><a class="dropdown-item" href="../Admin/A-dashboard">Admin Dashboard</a></li>
                        @elseif((auth()->user()->role == 'team'))
                            <li><a class="dropdown-item" href="../Team/T-dashboard">Team Dashboard</a></li>
                        @endif

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
<!-- //Navigation barr -->
