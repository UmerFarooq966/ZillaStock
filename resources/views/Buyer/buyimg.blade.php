<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Buying Image</title>

</head>

<body>
@include('Buyer.B-layouts.partials.navbar')
@extends('Buyer.B-layouts.index-master-for-Buyimage')
    <div class="bg-light p-5 rounded">
        @auth
            <h1>BuyImg</h1>
            <p class="lead">Only authenticated users can access this section.</p>





<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-12">

                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img src="https://preview.ibb.co/i0PmHk/1.jpg" /></div>

                    </div>
<!--DEKH lena yaha sy bad may bhulna mat!! -->
<!--https://www.positronx.io/laravel-add-text-overlay-watermark-on-image-tutorial/-->

                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">Image Name</h3>

                    <p class="product-description">img description etccccccccccccccccccccc.</p>

                    <!-- -->


                    <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="../images/indeximages/searchbg.jpg" /></a></li>

                    </ul><p class="Artist-description">Artist description etccccccccccccccccccccc.</p>
                    <h4 class="price">current price: <span>$10</span></h4>



                    <div class="action">
                        <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                        <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                        <a class="add-to-editor btn btn-default" href="/Editor/index" class="btn btn-dark" type="button">
                        Open Image in editor</button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

        @endauth
            @guest
                <h1>Buying image</h1>
                <p class="lead"> Please login to Download image.</p>
            @endguest
    </div>



</body>
</html>
