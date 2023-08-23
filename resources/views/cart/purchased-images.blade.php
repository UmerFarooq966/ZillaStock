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
    @include('Buyer.B-layouts.partials.lib')

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
                    <hr>
                    <div class="text-center">
    <h1><bold>Cart Items</bold></h1>

    <ul>@foreach($originalImages as $originalImage)
            @php
                $decodedImage = json_decode($originalImage);
                $imageFilename = $decodedImage->image;
            @endphp
            <div class="col-md-4">
                <form action="{{route('Seditor')}}" method="post">
                    @csrf
                    <input type="hidden" name="url" value="{{ asset('image/' . $imageFilename) }}">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="{{ asset('image/' . $imageFilename) }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ asset('image/' . $imageFilename) }}" download>Download</a>
                                <div class="btn-group">
                                    <button href="#" type="submit" class="btn btn-primary">Open Image In Editor</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach


    </ul>
                    </div>
<div class="text-center">
    <a href="{{ route('homee') }}" class="btn btn-primary">Return to Home</a>
</div>
                </div>

            </div>
            <!-- Transactions -->

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
