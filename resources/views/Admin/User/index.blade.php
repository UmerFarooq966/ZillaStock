


    @include('Admin.A-layouts.head')

    <body>

    @auth

        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->
                @include('Admin.A-layouts.partials.00SideMenu')

                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->

                    @include('Admin.A-layouts.partials.00Nav')


                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->

                        <div class="container-xxl flex-grow-1 container-p-y">


                            @auth
                                <div class="content-wrapper">
                                    @include('Admin.Team.create')
                                    <hr>
                                    <h1 class="text-center">Stock Managing Team</h1>
                                    @if(count($users)>0)
                                        <div class="container">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>No</th>
                                                    <th>User Name</th>
                                                    <th width="280px">Email</th>
                                                    <th width="280px">Role</th>
                                                </tr>
                                                @foreach ($users as $index =>$user)

                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            <a class="nav-link" href="{{ route('Com.show', $user->id) }}">
                                                                {{ $user->name }}
                                                            </a>
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->role }}</td>

                                                        <td>
                                                            <form action="{{ route('TTeam.destroy',$user->id) }}" method="POST">


                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>

                                                @endforeach
                                            </table>

                                            @else
                                                <p>No account found</p>
                                            @endif
                                            <a href="../A-dashboard">
                                                <button type="submit" class="btn btn-danger">back</button>
                                            </a>
                                        </div>
                                </div>

                            @endauth



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
        @include('Admin.A-layouts.partials.00js')
    @endauth

    @guest
        <h1>Oops wrong page</h1>
        <p class="lead">Your viewing the home page. Please log in to view the restricted data.</p>
    @endguest
    </body>
    </html>
