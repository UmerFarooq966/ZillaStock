

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


                                                @include('Admin.ImageCategory.create')

                                                <h1>Image categories</h1>

                                                @if ($Imagecategorys && count($Imagecategorys) > 0)
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Category type</th>
                                                            <th>Number of Images</th>
                                                            <th width="280px">Action</th>
                                                        </tr>
                                                        @foreach ($Imagecategorys as $index => $category)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $category->type }}</td>
                                                                <td>{{ $category->images()->count() }}</td> {{-- Count the number of images --}}
                                                                <td>
                                                                    <form action="{{ route('ImageCategory.destroy', $category->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPricesModal{{ $category->id }}">Edit Prices</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>

                                                    @foreach ($Imagecategorys as $category)
                                                        <div class="modal fade" id="editPricesModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editPricesModalLabel{{ $category->id }}" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editPricesModalLabel{{ $category->id }}">Edit Prices - {{ $category->type }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @php
                                                                            $images = $category->images();
                                                                            $imageCount = $images ? $images->count() : 0;
                                                                        @endphp

                                                                        @if ($imageCount > 0)
                                                                            <form id="editPricesForm{{ $category->id }}" action="{{ route('ImageCategory.update', $category->id) }}" method="POST">
                                                                                @csrf
                                                                                @method('PUT')

                                                                                <div class="form-group">
                                                                                    <label for="price">Price</label>
                                                                                    <input type="number" name="price" class="form-control" value="{{ $category->price ?? '' }}">
                                                                                </div>
                                                                            </form>
                                                                        @else
                                                                            <p class="text-muted">No images in this category</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        @if ($imageCount > 0)
                                                                            <button type="submit" class="btn btn-primary" form="editPricesForm{{ $category->id }}">Update Prices</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif


                                                <a href="{{route('Admin.home')}}">
                                                    <button type="submit" class="btn btn-danger">back</button>
                                                </a>




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
                            <h1>User Dashboard</h1>
                            <p class="lead">Your viewing the home page. Please log in to view the restricted data.</p>
                        @endguest
                        </body>
                        </html>
