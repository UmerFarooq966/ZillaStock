<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"

>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard</title>

    <meta name="description" content="" />


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
<!-- Layout wrapper -->

@include('Buyer.B-layouts.partials.navbar')

        <!-- Layout container -->



            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User/</span> Dashboard</h4>

                    <!-- Basic Layout & Basic with Icons -->
                    <div class="row">

                        <!-- Profile -->
                        <div class="col-xxl">
                            <div class="card mb-4">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">Profile</h5>
                                    <small class="text-muted float-end">Profile details</small>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Name</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                              <span id="basic-icon-default-fullname2" class="input-group-text"
                              ><i class="bx bx-user"></i
                                  ></span>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="basic-icon-default-fullname"
                                                        placeholder="John Doe"
                                                        aria-label="John Doe"
                                                        aria-describedby="basic-icon-default-fullname2"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Company</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                              <span id="basic-icon-default-company2" class="input-group-text"
                              ><i class="bx bx-buildings"></i
                                  ></span>
                                                    <input
                                                        type="text"
                                                        id="basic-icon-default-company"
                                                        class="form-control"
                                                        placeholder="ACME Inc."
                                                        aria-label="ACME Inc."
                                                        aria-describedby="basic-icon-default-company2"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
                                            <div class="col-sm-10">
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                    <input
                                                        type="text"
                                                        id="basic-icon-default-email"
                                                        class="form-control"
                                                        placeholder="john.doe"
                                                        aria-label="john.doe"
                                                        aria-describedby="basic-icon-default-email2"
                                                    />
                                                    <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                                                </div>
                                                <div class="form-text">You can use letters, numbers & periods</div>
                                            </div>
                                        </div>


                                        <div class="row justify-content-end">
                                            <div class="col-sm-10">
                                                <a href="/Buyer/Profile">
                                                <button type="button"  class="btn btn-primary">Edit</button>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Transactions -->
                        <div class="col-xxl">
                            <div class="card h-px-300">
                                <div class="overflow-scroll">

                                    <div class="card">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <div class="col-sm-10">
                                                <a href="/Buyer/Profile">
                                                    <button type="button"  class="btn btn-primary btn-sm btn-block">  <h5 class="card-title m-0 me-2 text-white">Transactions</h5></button>
                                                </a>
                                            </div>

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
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
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
                                                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                                    </div>
                                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <small class="text-muted d-block mb-1">Paypal</small>
                                                            <h6 class="mb-0">Bought</h6>
                                                        </div>
                                                        <div class="user-progress d-flex align-items-center gap-1">
                                                            <h6 class="mb-0">+8.6</h6>
                                                            <span class="text-muted">USD</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-body">
                                            <ul class="p-0 m-0">
                                                <li class="d-flex mb-4 pb-1">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                                    </div>
                                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <small class="text-muted d-block mb-1">Paypal</small>
                                                            <h6 class="mb-0">Bought</h6>
                                                        </div>
                                                        <div class="user-progress d-flex align-items-center gap-1">
                                                            <h6 class="mb-0">+8.6</h6>
                                                            <span class="text-muted">USD</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-body">
                                            <ul class="p-0 m-0">
                                                <li class="d-flex mb-4 pb-1">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                                    </div>
                                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <small class="text-muted d-block mb-1">Paypal</small>
                                                            <h6 class="mb-0">Bought</h6>
                                                        </div>
                                                        <div class="user-progress d-flex align-items-center gap-1">
                                                            <h6 class="mb-0">+8.6</h6>
                                                            <span class="text-muted">USD</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-body">
                                            <ul class="p-0 m-0">
                                                <li class="d-flex mb-4 pb-1">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                                    </div>
                                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <small class="text-muted d-block mb-1">Paypal</small>
                                                            <h6 class="mb-0">Bought</h6>
                                                        </div>
                                                        <div class="user-progress d-flex align-items-center gap-1">
                                                            <h6 class="mb-0">+8.6</h6>
                                                            <span class="text-muted">USD</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-body">
                                            <ul class="p-0 m-0">
                                                <li class="d-flex mb-4 pb-1">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                                    </div>
                                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <small class="text-muted d-block mb-1">Paypal</small>
                                                            <h6 class="mb-0">Bought</h6>
                                                        </div>
                                                        <div class="user-progress d-flex align-items-center gap-1">
                                                            <h6 class="mb-0">+8.6</h6>
                                                            <span class="text-muted">USD</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-body">
                                            <ul class="p-0 m-0">
                                                <li class="d-flex mb-4 pb-1">
                                                    <div class="avatar flex-shrink-0 me-3">
                                                        <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                                    </div>
                                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <small class="text-muted d-block mb-1">Paypal</small>
                                                            <h6 class="mb-0">Bought</h6>
                                                        </div>
                                                        <div class="user-progress d-flex align-items-center gap-1">
                                                            <h6 class="mb-0">+8.6</h6>
                                                            <span class="text-muted">USD</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>

                                        </div>


                                    </div>


                                </div>



                        </div>
                        <!--/ Transactions -->

                    </div>
                    <!-- favourits-->
                    <div class="row-cols-2">

                </div>
                </div>
                <!-- / Content -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->

<!-- / Layout wrapper -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

</body>
</html>
