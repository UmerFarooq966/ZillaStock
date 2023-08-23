@include('Contributor.C-layouts.head')

<body>

@auth

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @if (auth()->user()->role == 'user')
                @include('Contributor.C-layouts.partials.00SideMenu')
            @elseif((auth()->user()->role == 'admin'))
                @include('Admin.A-layouts.partials.00SideMenu')
            @elseif((auth()->user()->role == 'team'))
                @include('Team.T-layouts.partials.00SideMenu')
            @endif


            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @if (auth()->user()->role == 'user')
                    @include('Contributor.C-layouts.partials.00Nav')
                @elseif((auth()->user()->role == 'admin'))
                    @include('Admin.A-layouts.partials.00Nav')
                @elseif((auth()->user()->role == 'team'))
                    @include('Team.T-layouts.partials.00Nav')
                @endif




                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profile /</span> Profile Settings</h4>

                            <div class="row">
                                <div class="col-md-12 ">

                                    <div class="card mb-6">


                                        <!-- Account -->
                                        <div class="container mt-5">
                                            <div class="row">
                                                <div class="col-md-9 personal-info">



                                                    @if(session()->has('success'))
                                                        <div class="alert alert-success">
                                                            {{ session()->get('success') }}
                                                        </div>
                                                    @endif

                                                    @if(session()->has('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session()->get('error') }}
                                                        </div>
                                                    @endif




                                                    <h3>Personal Information</h3>
                                                    <form method="POST" action="{{route('Com.save')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="text-center col-sm-3">
                                                            @if ($Profilee->avatar)
                                                                <img src="/images/avatars/{{ $Profilee->avatar }}" class="img-thumbnail" alt="avatar">
                                                            @else
                                                                <img src="/images/avatars/placeholder.jpg" class="img-thumbnail" alt="placeholder">
                                                            @endif
                                                            <h6>Upload a different photo...</h6>
                                                            <input type="file" name="avatar" class="form-control">
                                                        </div>



                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="{{ $Profilee->name }}" readonly >
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="full_name">Full Name</label>
                                                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $Profilee->full_name ) }}" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="bio" class="col-lg-3 control-label">Bio:</label>
                                                            <div class="col-lg-8">
                                                                <input class="form-control" id="bio" name="bio" type="text" placeholder="bio" value="{{ old('bio', $Profilee->bio ) }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="phone" class="col-lg-3 control-label">Phone:</label>
                                                            <div class="col-lg-8">
                                                                <input class="form-control" id="phone" name="phone" type="text" value="{{ old('phone', $Profilee->phone)  }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address" class="col-lg-3 control-label">Address:</label>
                                                            <div class="col-lg-8">
                                                                <input class="form-control" id="address" name="address" type="text" value="{{ old('address', $Profilee->address) }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="city" class="col-lg-3 control-label">City:</label>
                                                            <div class="col-lg-8">
                                                                <input class="form-control" id="city" name="city" type="text" value="{{ old('city', $Profilee->city) }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="state" class="col-lg-3 control-label">State:</label>
                                                            <div class="col-lg-8">
                                                                <input class="form-control" id="state" name="state" type="text" value="{{ old('state', $Profilee->state ) }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="zip" class="col-lg-3 control-label">Zip/Postal code:</label>
                                                            <div class="col-lg-8">
                                                                <input class="form-control" id="zip" name="zip" type="text" value="{{ old('zip', $Profilee->zip ) }}">
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label"></label>
                                                            <div class="col-md-8">
                                                                <button type="submit" class="btn btn-primary">Save Changes</button>


                                                            </div>
                                                        </div>


                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Account -->
                                    </div>
                                    <div class="card mb-6">


                                        <!-- Account -->
                                        <div class="container mt-5">
                                            <div class="row">
                                                <div class="col-md-9 personal-info">



                                                    @if(session()->has('success'))
                                                        <div class="alert alert-success">
                                                            {{ session()->get('success') }}
                                                        </div>
                                                    @endif

                                                    @if(session()->has('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session()->get('error') }}
                                                        </div>
                                                    @endif




                                                    <h3>Socials</h3>


                                                        <div class="form-group">
                                                            <label for="instagram">Instagram Username</label>
                                                            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $Profilee->instagram ) }}" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="facebook" class="col-lg-3 control-label">Facebook UserId</label>
                                                            <div class="col-lg-8">
                                                                <input class="form-control" id="bio" name="facebook" type="text" placeholder="like id=100000000" value="{{ old('facebook', $Profilee->facebook ) }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="twitter" class="col-lg-3 control-label">Twitter Username</label>
                                                            <div class="col-lg-8">
                                                                <input class="form-control" id="twitter" name="twitter" type="text"  value="{{ old('twitter', $Profilee->twitter)  }}">
                                                            </div>
                                                        </div>




                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label"></label>
                                                            <div class="col-md-8">
                                                                <button type="submit" class="btn btn-primary">Save Changes</button>


                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Account -->
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <!-- / Content -->


                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    @include('Contributor.C-layouts.partials.00js')
@endauth

@guest

    <p class="lead">Your viewing the home page. Please log in to view the restricted data.</p>
@endguest
</body>
</html>
