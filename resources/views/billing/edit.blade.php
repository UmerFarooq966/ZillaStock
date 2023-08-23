

@include('Contributor.C-layouts.head')

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




<form action="{{ route('billing.update') }}" method="POST">
    @csrf
    <!-- Input fields -->

    <div class="form-group">
        <label for="phone" class="col-lg-3 control-label">BankAccount:</label>
        <div class="col-lg-8">
            <input class="form-control" type="text" name="bank_account" value="{{ old('bank_account',$billing->bank_account) }}" />
            <div class="form-group">
                <label for="phone" class="col-lg-3 control-label"> Routing Number:</label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" name="routing_number" value="{{ old('routing_number',$billing->routing_number) }}" />
                    <div class="form-group">
                        <label for="phone" class="col-lg-3 control-label">Account Holder_name</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="account_holder_name" value="{{ old('account_holder_name',$billing->account_holder_name) }}" />
                            <div class="form-group">
                                <label for="phone" class="col-lg-3 control-label">Bbank_name:</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="text" name="bank_name" value="{{ old('bank_name',$billing->bank_name) }}" />
<hr>
    <button class="btn btn-dark" type="submit">Save</button>
</form>

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
