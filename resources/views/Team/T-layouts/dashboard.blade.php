@include('Team.T-layouts.head')
@include('Team.T-layouts.createStyle')

<body>

@auth

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('Team.T-layouts.partials.00SideMenu')

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('Team.T-layouts.partials.00Nav')


                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">


                        @include('Team.T-layouts.partials.00A-dash-content')


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
