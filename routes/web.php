<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ImageCategoryController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Contributor\ContributorController;
use App\Http\Controllers\Editor\EditorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\UserDashController;

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();


Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

// Route User
Route::middleware(['auth','user-role:user'])->group(function()
{
    Route::get("/home",[HomeController::class, 'userHome'])->name("home");
});
// Route Editor
Route::middleware(['auth','user-role:editor'])->group(function()
{
    Route::get("/editor/home",[HomeController::class, 'editorHome'])->name("editor.home");
});
// Route Admin
Route::middleware(['auth','user-role:admin'])->group(function()
{
    Route::get("/admin/home",[HomeController::class, 'adminHome'])->name("admin.home");
});



Route::controller(UserDashController::class)->group(function () {
    Route::get('/Buyer/B-dashboard', 'UserDashboard');
    Route::get('/Buyer/Profile', 'UserProfile');
    Route::get('/Buyer/Favourites', 'Favourites');
    Route::get('/Buyer/buyimg', 'Buyimage');

});

Route::controller(ContributorController::class)->group(function (){

   Route::get('/Contributor/C-dashboard', 'ContributorDashboard');

});

//*************************ADMIN******************************\\


Route::controller(AdminController::class)->group(function () {
    Route::get('/Admin/A-dashboard', 'Adminhome');

});

Route::resource('Admin/ImageCategory', ImageCategoryController::class);


Route::resource('Admin/Team', TeamController::class);

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
    Route::get('/Editor/index', 'Editor')->name("editor.home");

});


//Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
//Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//Route::get('/Buyer/B-dashboard', [UserDashController::class, 'UserDashboard']);
//Route::post('/logout' , 'Auth\LoginController@logout');
