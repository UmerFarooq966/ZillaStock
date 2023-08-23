@include('Contributor.C-layouts.head')

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

                        <div class="container">

                            <!-- Toggle buttons -->
                            <div class="mb-3">
                                <a href="{{ route('reports.index', ['status' => 'pending']) }}" class="btn btn-primary {{ $status === 'pending' ? 'active' : '' }}">Pending Reports</a>
                                <a href="{{ route('reports.index', ['status' => 'approved']) }}" class="btn btn-success {{ $status === 'approved' ? 'active' : '' }}">Approved Reports</a>
                            </div>

                            <!-- Reports -->
                            @foreach($reports as $imageId => $groupedReports)
                                @php
                                    $image = $groupedReports->first()->image;
                                    $reportCount = $groupedReports->count();
                                @endphp

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $imageId }}">
                                                {{ $image->name }}
                                            </a>
                                        </h5>
                                        <p class="card-text">Report Count: {{ $reportCount }}</p>
                                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#reportsCollapse{{ $imageId }}" aria-expanded="false" aria-controls="reportsCollapse{{ $imageId }}">
                                            View Reports
                                        </button>
                                    </div>
                                    <div class="collapse" id="reportsCollapse{{ $imageId }}">
                                        <div class="card-body">
                                            @foreach($groupedReports as $report)
                                                <div>
                                                    <!-- Display report details here -->
                                                    <a class="nav-link" href="{{ route('Com.show', $report->reporter_id) }}" target="_blank">
                                                        <p>Reporter ID: {{ $report->reporter_id }}</p>
                                                    </a>
                                                    <p>Reported At: {{ $report->created_at->diffForHumans() }}</p>
                                                    <p>Report Details: <b>{{ $report->reason }}</b></p>
                                                    <div class="d-flex">
                                                        <form action="{{ route('removeReport', $report->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Remove Report</button>
                                                        </form>
                                                        <button type="button" class="btn btn-warning ms-2" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $image->id }}">Change Image Status</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Modal -->
                                <div class="modal fade" id="imageModal{{ $imageId }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $imageId }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel{{ $imageId }}">{{ $image->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="/image/{{ $image->image }}" class="img-fluid" alt="{{ $image->name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Rejection Modal -->
                                <div class="modal fade" id="rejectModal-{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('changeImageStatus', $image->id) }}" method="POST">
                                                @csrf
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
    <h1>User Dashboard</h1>
    <p class="lead">Your viewing the home page. Please log in to view the restricted data.</p>
@endguest
</body>
</html>
