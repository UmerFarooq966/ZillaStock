@include('Team.T-layouts.head')
@include('Team.T-layouts.createStyle')

<body>

@auth

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @if((auth()->user()->role == 'admin'))
                @include('Admin.A-layouts.partials.00SideMenu')
            @elseif((auth()->user()->role == 'team'))
                @include('Team.T-layouts.partials.00SideMenu')
            @endif

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @if((auth()->user()->role == 'admin'))
                    @include('Admin.A-layouts.partials.00Nav')
                @elseif((auth()->user()->role == 'team'))
                    @include('Team.T-layouts.partials.00Nav')
                @endif


                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">

                    <table class="table">
    <thead>
    <tr>
        <th>Image Name</th>
        <th>Image URL</th>
        <th>Uploaded Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($images as $image)
        <tr>
            <td>{{ $image->name }}</td>


            <td> <img src="/image/{{ $image->image }}" alt="image" class="img-fluid rounded" width="10%" type="button" data-bs-toggle="modal" data-bs-target="#myModal{{ $loop->index }}">

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
                                    @foreach($image->tags as $tag)
                                        <label class="badge bg-primary">{{ $tag->name }}</label>
                                    @endforeach
                                </div>
                            </div>



                            <img src="/image/{{ $image->image }}" height="500px" type="button" alt="deleted image" data-bs-toggle="modal" data-bs-target="#zoomModal{{ $loop->index }}">

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
                <!-- /The First Modal -->

                <!-- The Second Modal -->
                <div class="modal fade" id="zoomModal{{ $loop->index }}">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Zoomed Image</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
            	<span class='zoom' id='ex2'>
                                <img src="/image/{{ $image->image }}" alt="image" />
                </span>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /The Second Modal -->
        </td>
            <td>{{ $image->created_at }}</td>
            <td>
                <form action="{{ route('images.reject', $image) }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="post">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectModal-{{ $image->id }}">Reject</button>
                    <!-- Rejection Modal -->
                    <!-- Rejection Modal -->
                    <div class="modal fade" id="rejectModal-{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">

                    <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rejectModalLabel">Rejection Reason</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="reason">Reason</label>
                                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Reject</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{ route('images.approve', $image) }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="post">
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>



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
    @include('Team.T-layouts.partials.00js')
@endauth

@guest
    <h1>User Dashboard</h1>
    <p class="lead">Your viewing the home page. Please log in to view the restricted data.</p>
@endguest

</body>
</html>
