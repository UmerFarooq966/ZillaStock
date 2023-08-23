<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 mb-4">

                  <div class="card h-100">
                        <div class="card-body">
                            <div
                                class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img
                                        src="../assets/img/icons/unicons/chart-success.png"
                                        alt="chart success"
                                        class="rounded"
                                    />
                                </div>
                                <div class="dropdown">
                                    <button
                                        class="btn p-0"
                                        type="button"
                                        id="cardOpt3"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end"
                                         aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{route('getTotalRevenueAndSalesimage')}}">View
                                            More</a>

                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Profit</span>
                            <h3 class="card-title mb-2">${{$totalRevenue}}</h3>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 mb-4">

                    <div class="card h-100">
                        <div class="card-body">
                            <div
                                class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img
                                        src="../assets/img/icons/unicons/wallet-info.png"
                                        alt="Credit Card"
                                        class="rounded"
                                    />
                                </div>
                                <div class="dropdown">
                                    <button
                                        class="btn p-0"
                                        type="button"
                                        id="cardOpt6"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end"
                                         aria-labelledby="cardOpt6">
                                        <a class="dropdown-item" href="{{route('getTotalRevenueAndSalesimage')}}">View
                                            More</a>
                                    </div>
                                </div>
                            </div>
                            <span>Sales</span>
                            <h3 class="card-title text-nowrap mb-1">{{$totalSales}}</h3>
                            <small class="text-success fw-semibold"> </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- website Statistics -->
        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Statistics</h5>
                        <small class="text-muted">42k Total visits</small>
                    </div>
                    <div class="dropdown">
                        <button
                            class="btn p-0"
                            type="button"
                            id="orederStatistics"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"
                             aria-labelledby="orederStatistics">
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">8,258</h2>
                            <span>Total visits</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Transactions -->
        <div class="col-md-6 col-lg-4 order-2 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Transactions</h5>
                    <div class="dropdown">
                        <button
                            class="btn p-0"
                            type="button"
                            id="transactionID"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"
                             aria-labelledby="transactionID">
                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="../assets/img/icons/unicons/paypal.png" alt="User"
                                     class="rounded"/>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Paypal</small>
                                    <h6 class="mb-0">Send money</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">+82.6</h6>
                                    <span class="text-muted">USD</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="../assets/img/icons/unicons/wallet.png" alt="User"
                                     class="rounded"/>
                            </div>
                            <div
                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <small class="text-muted d-block mb-1">Wallet</small>
                                    <h6 class="mb-0">Mac'D</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                    <h6 class="mb-0">+270.69</h6>
                                    <span class="text-muted">USD</span>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!--/ Transactions -->
    </div>

    <hr>
    <div class="row text-center">
<h1>Portfolio</h1>

    </div>




    <div class="row">
        <div class="container">

            <div class="dropdown"> <hr>

                <button class="btn btn-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort By
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                    <li><a class="dropdown-item" href="{{ route('show.sort', ['sort' => 'date']) }}">Date</a></li>
                    <li><a class="dropdown-item" href="{{ route('show.sort', ['sort' => 'purchases']) }}">Purchases</a></li>
                </ul>
            </div>

            <ul>
                <br>
                <div class="message">
                    {{ $message }}
                </div>
                @foreach ($images as $image)


                    <img src="/image/{{ $image->image }}" style="width: 160px; height: 160px;" alt="image" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: contain;" type="button" data-bs-toggle="modal" data-bs-target="#myModal{{ $loop->index }}">

                   <!-- <img src="/image/{{ $image->image }}" alt="image" class="img-fluid rounded" width="10%" type="button" data-bs-toggle="modal" data-bs-target="#myModal{{ $loop->index }}">
                    --> <!-- The Modal -->

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


                                    <img src="/image/{{ $image->image }}" height="500px" type="button" alt="deleted image">

                                </div>
                                <div class="modal-footer">

                                    <div class="form-group">
                                        <strong>Approved at:</strong>
                                        {{ $image->updated_at }}
                                    </div>

                                    <!-- Modal footer -->

                                    <td>
                                        <form action="{{ route('UploadImages.destroy',$image->id) }}"
                                              method="POST">


                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-flat show_confirm" >Delete</button>
                                        </form>
                                    </td>

                                </div>

                            </div>
                        </div>
                    </div>

                @endforeach
            </ul>
        </div>


    </div>
</div>
