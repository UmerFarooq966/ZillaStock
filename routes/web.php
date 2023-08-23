<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AUserController;
use App\Http\Controllers\Admin\ImageCategoryController;
use App\Http\Controllers\Admin\ATeamController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Contributor\ContributorController;
use App\Http\Controllers\Contributor\ImageController;
use App\Http\Controllers\Editor\EditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Main\GalleryController;
use App\Http\Controllers\Main\SearchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Team\ImageRejectionController;
use App\Http\Controllers\Team\TeamController;
use App\Http\Controllers\User\FavouriteController;
use App\Http\Controllers\User\UserDashController;

use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/**** test
Route::get('/', function () {
    return view('index');
});
****/

//**** test ****\\

Route::get('/Admin/A-layouts/partials/00A-dash', function () {
    return view('00A-dash');
});
//**** /test/ ****\\


Route::controller(GalleryController::class)->group(function () {
    Route::get('/', 'index')->name("homee");

});

//Route::resource('/I-layouts', GalleryController::class);

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('I-layouts/show/{id}', [SearchController::class, 'show'])->name('showw');


Auth::routes();
Auth::routes(['verify'=>true]);

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');


//Route::get('Com/Profile', [UserProfileController::class, 'index'])->name('Com.Profile');

Route::controller(UserProfileController::class)->group(function () {

    Route::get('/Com/Profile', 'index')->name('Com.index');

// Display the form to create/update user profile
    Route::post('/Com/Profile', 'save')->name('Com.save');



// show the user profile
    Route::get('/Com/UserProfile/{id}','show')->name('Com.show');
    Route::get('/Com/UserProfile/{id}','team')->name('Com.show');

});

//********************** Favourite Controller ************\\

Route::controller(FavouriteController::class)->group(function () {

    // Show user's favorite images
    Route::get('/Buyer/Favourites', 'index')->name('Buyer.showFavorites');

// Add image to favorites
    Route::post('/Buyer/Favourites', 'save')->name('Buyer.addToFavorites');


// show the user profile
    Route::post('/Buyer/Favourites/{id}',  'removeFromFavorites')->name('Buyer.removeFromFavorites');



});


// Route User
Route::middleware(['auth','user-role:user'])->group(function()
{
    Route::get("/home",[HomeController::class, 'Home'])->name("home");
});
// Route Editor
Route::middleware(['auth','user-role:editor'])->group(function()
{
    Route::get("/team/home",[HomeController::class, 'teamHome'])->name("team.home");
});
// Route Admin
Route::middleware(['auth','user-role:admin'])->group(function()
{
    Route::get("/admin/home",[HomeController::class, 'adminHome'])->name("admin.home");
});


//*************************  User  ******************************\\

Route::controller(UserDashController::class)->group(function () {
    Route::get('/Buyer/B-dashboard', 'UserDashboard');
    Route::get('/Buyer/Profile', 'UserProfile');

});
Route::get('/billing/edit', [WithdrawalController::class, 'edit'])->name('billing.edit');

Route::post('/billing/update', [WithdrawalController::class, 'update'])->name('billing.update');


//*************************  Contributor  ******************************\\

Route::controller(ContributorController::class)->group(function (){

   Route::get('/Contributor/C-dashboard', 'ContributorDashboard');
   Route::get('/Contributor/C-dashboard', 'getTotalRevenueAndSales');
   Route::get('/Contributor/C-dashboard', 'show')->name('show.sort');
   Route::get('/Contributor/dash-content/sales', 'getTotalRevenueAndSalesimage')->name('getTotalRevenueAndSalesimage');

});

Route::get('Contributor/UploadImages/rejected', [ImageController::class, 'rejected'])->name('UploadImages.rejected');

Route::resource('Contributor/UploadImages', ImageController::class);




Route::controller(ReportController::class)->group(function (){

    Route::get('/report/{image}', 'showReportForm')->name('report.form');
    Route::post('/report/{image}', 'storeReport')->name('report.store');
    Route::get('/reports', 'index')->name('reports.index');

    Route::delete('/reports/{report}', 'remove')->name('removeReport');
    Route::post('/reports/{image}', 'changeStatus')->name('changeImageStatus');


});


//*************************  Purchase  ******************************\\

                    // Cart routes

Route::controller(CartController::class)->group(function (){



    Route::get('/cart', 'showCart')->name('cart.show');
    Route::post('/cart/add', 'addToCart')->name('cart.add');
    Route::delete('/cart/remove/{cartItemId}', 'removeFromCart')->name('cart.remove');
    Route::get('/checkout', 'checkout')->name('checkout.bro');
    Route::get('/cart/checkout/completePayment', 'completePayment')->name('checkout.complete');
    Route::get('/cart/purchased-images', 'purchasedImages')->name('purchased-images');

});









//*************************  Team  ******************************\\
Route::controller(TeamController::class)->group(function (){

    Route::get('/Team/T-dashboard', 'Teamhome')->name('team.Teamhome');
});

Route::controller(ImageRejectionController::class)->group(function (){

    Route::get('Team/ManageImages', 'index')->name('images.index');
    Route::post('Team/ManageImages/{image}/reject', 'reject')->name('images.reject');
    Route::post('Team/ManageImages/{image}/approve', 'approve')->name('images.approve');

});



//*************************  ADMIN  ******************************\\




Route::controller(AdminController::class)->group(function () {
    Route::post('/', 'updateImage')->name('admin.uploadImage');
    Route::get('/Admin/A-dashboard', 'getTotalRevenueAndSales')->name('Admin.home');
    Route::get('/Admin/dash-content/sales', 'getTotalRevenueAndSalesimage')->name('Admin.getTotalRevenueAndSalesimage');

});

Route::post('Admin/Team', [ATeamController::class, 'store'])->name('TTeam.store');

Route::controller(ATeamController::class)->group(function () {
    Route::get('Admin/Team/', 'index')->name('TTeam.index');
    Route::delete('Admin/Team/{id}', 'destroy')->name('TTeam.destroy');

});


Route::post('Admin/User', [AUserController::class, 'store'])->name('Userr.store');

Route::controller(AUserController::class)->group(function () {
    Route::get('Admin/User/', 'index')->name('Userr.index');
    Route::delete('Admin/User/{id}', 'destroy')->name('Userr.destroy');

});

Route::resource('Admin/ImageCategory', ImageCategoryController::class);



/*
Route::controller(ImageCategoryController::class)->group(function () {
    Route::get('/Admin/ImageCategory/index', 'index');
    Route::get('/Admin/ImageCategory/create', 'create');
    Route::post('/Admin/ImageCategory/index', 'store');
    Route::post('/Admin/ImageCategory/create', 'index');
    Route::delete('/Admin/ImageCategory/index', 'destroy');

});
*/

Route::controller(EditorController::class)->group(function () {
    Route::get('/Editor/editor', 'Editor')->name("editor.home");


});
Route::post('Editor/editor', [EditorController::class, 'showEditor'])->name('Seditor');

//Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
//Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//Route::get('/Buyer/B-dashboard', [UserDashController::class, 'UserDashboard']);
//Route::post('/logout' , 'Auth\LoginController@logout');
