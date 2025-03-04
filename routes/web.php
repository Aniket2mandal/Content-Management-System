<?php





use App\Http\Controllers\Backend\AuthorController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SeoController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Frontend\AboutusController;
use App\Http\Controllers\Frontend\ContactusController;
use App\Http\Controllers\Frontend\FrontpageController;
use App\Http\Controllers\Frontend\HeaderController;
use App\Http\Controllers\Frontend\PostdetailController;

use App\Http\Controllers\Frontend\PostlistController;
use App\Http\Controllers\HomeController;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/welcome', function () {
//     return view('frontend.layout.app');
// });

Route::get('/', [HeaderController::class, 'index'])->name('front.home');
Route::get('/testimonial', [HeaderController::class, 'testimonial'])->name('front.testimonial');

Route::get('/list/{id}', [PostlistController::class, 'index'])->name('front.postlist');
Route::get('/latest', [PostlistController::class, 'latestpost'])->name('front.latestpostlist');
Route::get('/author/{id}', [PostlistController::class, 'authorpost'])->name('front.authorpost');

Route::get('/detail/{id}', [PostdetailController::class, 'index'])->name('front.postdetail');
Route::get('/search', [PostdetailController::class, 'search'])->name('front.postsearch');

// ROUTES FOR CONTACT US FORM
Route::get('/contactus', [ContactusController::class, 'index'])->name('front.contactus');
Route::post('/contactus/store', [ContactusController::class, 'store'])->name('front.contactstore');
// PAGE
Route::get('/pagedata/{slug}', [FrontpageController::class, 'pagedetail'])->name('front.pagedetail');



Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');



    // CATEFORY
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/home', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::post('/status/{id}', [CategoryController::class, 'status'])->name('status');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    });

    // POST
    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/home', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [PostController::class, 'update'])->name('update');
        Route::post('/status/{id}', [PostController::class, 'status'])->name('status');
        Route::get('/delete/{id}', [PostController::class, 'delete'])->name('delete');
    });
    


    // AUTHOR
    Route::prefix('authors')->name('author.')->group(function () {
        Route::get('/home', [AuthorController::class, 'index'])->name('index');
        Route::get('/create', [AuthorController::class, 'create'])->name('create');
        Route::post('/store', [AuthorController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name('edit');
        Route::post('/status/{id}', [AuthorController::class, 'status'])->name('status');
        Route::post('/update/{id}', [AuthorController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [AuthorController::class, 'delete'])->name('delete');
    });
    


    // ROLE
    Route::prefix('role')->name('role.')->group(function () {
        Route::get('/home', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
    });
    
    // PERMISSION
    Route::prefix('permission')->name('permission.')->group(function () {
        Route::get('/home', [PermissionController::class, 'index'])->name('index');
        Route::get('/create', [PermissionController::class, 'create'])->name('create');
        Route::post('/store', [PermissionController::class, 'store'])->name('store');
    });
    

    // USER
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/home', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/status/{id}', [UserController::class, 'status'])->name('status');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });
    

    // PAGES
    Route::prefix('page')->name('page.')->group(function () {
        Route::get('/home', [PageController::class, 'index'])->name('index');
        Route::get('/create', [PageController::class, 'create'])->name('create');
        Route::post('/store', [PageController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PageController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PageController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [PageController::class, 'delete'])->name('delete');
        Route::post('/status/{id}', [PageController::class, 'status'])->name('status');
    });
    

    // SEO
    Route::prefix('seo')->name('seo.')->group(function () {
        Route::get('/index', [SeoController::class, 'index'])->name('index');
        Route::get('/field/create', [SeoController::class, 'create'])->name('fieldcreate');
        Route::post('/field/store', [SeoController::class, 'store'])->name('fieldstore');
        Route::get('/field/edit/{id}', [SeoController::class, 'fieldedit'])->name('fieldedit');
        Route::post('/field/update', [SeoController::class, 'fieldupdate'])->name('fieldupdate');
        Route::put('/update', [SeoController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [SeoController::class, 'delete'])->name('delete');
    });
    


    // TESTIMONIAL
    Route::prefix('testimonial')->name('testimonial.')->group(function () {
        Route::get('/index', [TestimonialController::class, 'index'])->name('index');
        Route::get('/create', [TestimonialController::class, 'create'])->name('create');
        Route::post('/store', [TestimonialController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TestimonialController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [TestimonialController::class, 'update'])->name('update');
        Route::post('/status/update/{id}', [TestimonialController::class, 'statusUpdate'])->name('statusupdate');
        Route::get('/delete/{id}', [TestimonialController::class, 'delete'])->name('delete');
    });
    

    // PARTNERS
    Route::prefix('partner')->name('partner.')->group(function () {
        Route::get('/index', [PartnerController::class, 'index'])->name('index');
        Route::get('/create', [PartnerController::class, 'create'])->name('create');
        Route::post('/store', [PartnerController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PartnerController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [PartnerController::class, 'update'])->name('update');
        Route::post('/status/update/{id}', [PartnerController::class, 'statusUpdate'])->name('statusupdate');
        Route::get('/delete/{id}', [PartnerController::class, 'delete'])->name('delete');
    });
    

    // SLIDERS
    Route::prefix('slider')->name('slider.')->group(function () {
        Route::get('/index', [SliderController::class, 'index'])->name('index');
        Route::get('/create', [SliderController::class, 'create'])->name('create');
        Route::post('/store', [SliderController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SliderController::class, 'update'])->name('update');
        Route::post('/status/update/{id}', [SliderController::class, 'statusUpdate'])->name('statusupdate');
        Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('delete');
    });
    


    // ERROR
    Route::get('/logger', [ErrorController::class, 'showError'])->name('logger.error');
});




// FRONTEND

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
