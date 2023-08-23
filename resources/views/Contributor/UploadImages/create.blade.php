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



                            @auth()


                                <div class="row">

                                    <div class="col-lg-12 margin-tb">

                                        <div class="pull-left">

                                            <h2>Add New image</h2>

                                        </div>


                                    </div>

                                </div>

                                @if ($errors->any())

                                    <div class="alert alert-danger">

                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>

                                        <ul>

                                            @foreach ($errors->all() as $error)

                                                <li>{{ $error }}</li>

                                            @endforeach

                                        </ul>

                                    </div>

                                @endif

                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                        @php
                                            Session::forget('success');
                                        @endphp
                                    </div>
                                @endif

                                <div class="container">
                                    <form action="{{ route('UploadImages.store') }}" method="POST" enctype="multipart/form-data" class="clearfix">

                                        @csrf





                                        <div class="form-inputs">
                                            <label for="category">Category:</label>
                                            <select id="catid" name="catid" required>
                                                <option value="" disabled selected>Select category</option>
                                                @foreach ($Imagecategorys as $category)
                                                    <option name="catid" value="{{ $category->id}}">{{ $category->type }}</option>

                                                @endforeach
                                            </select>
                                            <br>


                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Name:</strong>
                                                    <input type="text" name="name" class="form-control" placeholder="Name">
                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Detail:</strong>
                                                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-image">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Image:</strong>
                                                    <input type="file" name="image" class="form-control" onchange="previewImage(event)">

                                                </div>
                                                <img id="preview" style="width: 200px; height: auto"/>
                                            </div>
                                        </div>

                                        <div class="form-inputs">
                                            <label for="tags">Tags:</label>
                                            <input class="form-control" type="text" data-role="tagsinput" name="tags">
                                            @if ($errors->has('tags'))
                                                <span class="text-danger">{{ $errors->first('tags') }}</span>
                                            @endif                                        </div>


                                        <div class="form-inputs">

                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <br>
                                            <button type="submit" class="btn btn-info btn-submit">Submit</button>
                                        </div>
                                        </div>




                                    </form>
                                </div>
<br>
                                    <div class="row text-center">

                                        <div class="col-lg-12 margin-tb">


                                            <div class="pull-right">

                                                <a class="btn btn-primary" href="../C-dashboard"> Back</a>

                                            </div> <br>

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
        @include('Contributor.C-layouts.partials.00js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
        <script>
            function previewImage(event) {
                let reader = new FileReader();
                reader.onload = function() {
                    let preview = document.getElementById('preview');
                    preview.src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
        <script>
            function setCategoryId(value) {
                document.getElementById("catid").value = value;
            }



            //************* drag and drop area ************************



            //************* //drag and drop area ************************




            //multiple images upload but submit one by one

            let images = [image1, image2, image3];

            for (let i = 0; i < images.length; i++) {
                let image = images[i];

                // Submit the image to the server
                submitImage(image);
            }

            function submitImage(image) {
                let formData = new FormData();
                formData.append('image', image);

                fetch('../create', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    });
            }

        </script>

    @endauth

    @guest
        <h1>User Dashboard</h1>
        <p class="lead">Your viewing the home page. Please log in to view the restricted data.</p>
    @endguest
    </body>
    </html>
