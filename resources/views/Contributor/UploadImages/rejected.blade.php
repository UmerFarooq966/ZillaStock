@include('Contributor.C-layouts.head')
@include('Contributor.C-layouts.createStyle')



<body>

@auth

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('Contributor.C-layouts.partials.00SideMenu')

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('Contributor.C-layouts.partials.00Nav')


                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">


                        <div class="container-xxl flex-grow-1 container-p-y">



                            <div class="row">
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-left">
                                        <h2> Rejected Images</h2>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="message">
                                {{ $message }}
                            </div>
                            @foreach ($images as $image)



                                <img src="/image/{{ $image->image }}" alt="image" class="img-fluid rounded" width="10%" type="button" data-bs-toggle="modal" data-bs-target="#myModal{{ $loop->index }}">
                                <!-- The Modal -->

                                <div class="modal fade" id="myModal{{ $loop->index }}">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">      </h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="form-inputs">
                                                    <div class="form-group">
                                                        <strong>Title:</strong>
                                                        {{ $image->name  }}
                                                    </div>

                                                    <div class="form-group">
                                                        <strong>Details:</strong>
                                                        {{ $image->detail }}
                                                    </div>

                                                    <div class="form-group">
                                                        <strong>Keywords:</strong>
                                                        @if (!is_null($image->tags))
                                                            @foreach($image->tags as $tag)
                                                                <label class="badge bg-primary">{{ $tag->name }}</label>
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <strong>Rejection reason:</strong>
                                                        {{$image->rejection_reason}}
                                                    </div>
                                                </div>


                                                <img src="/image/{{ $image->image }}" height="500px" type="button" alt="Rejected image">

                                            </div>


                                            <div class="modal-footer">
                                                <div class="form-group">
                                                    <strong>Rejected at:</strong>
                                                    {{ $image->updated_at }}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @endforeach

                            <!-- Button to back -->
                            <br>
                            <br>
                            <br>
                            <div class="bx-pull-left" >
                                <a class="btn btn-primary" href="/Contributor/C-dashboard"> Back</a>
                            </div>




                        </div>
                        <!-- / Content -->

                        <!-- Core JS -->
                        @include('Contributor.C-layouts.partials.00js')


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
    <h1>User Dashboard</h1>
    <p class="lead">Your viewing the home page. Please log in to view the restricted data.</p>
@endguest
</body>
</html>
