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
use App\Http\Controllers\Frontend\HeaderController;
use App\Http\Controllers\Frontend\PostdetailController;
use App\Http\Controllers\Frontend\PostlistController;
use App\Http\Controllers\HomeController;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

// Route::get('/welcome', function () {
//     return view('frontend.layout.app');
// });

Route::get('/front/home', [HeaderController::class, 'index'])->name('front.home');
Route::get('/front/postlist/{id}',[PostlistController::class,'index'])->name('front.postlist');
Route::get('/front/latestpostlist',[PostlistController::class,'latestpost'])->name('front.latestpostlist');
Route::get('/front/postdetail/{id}',[PostdetailController::class,'index'])->name('front.postdetail');
Route::get('/front/author/post/{id}', [PostlistController::class, 'authorpost'])->name('front.authorpost');
// Route::get('/front/authorlist',[AuthorlistController::class,'index'])->name('front.auhtordetail');


Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    // USER
    // Route::get('/userhome', [UserController::class, 'index'])->name('user.index');
    // Route::get('/usercreate', [UserController::class, 'create'])->name('user.create');




    // CATEFORY
    Route::get('/category/home', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categoryedit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/categorystatus/{id}', [CategoryController::class, 'status'])->name('category.status');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // POST

    Route::get('/post/home', [PostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::post('/poststatus/{id}', [PostController::class, 'status'])->name('post.status');
    Route::get('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');


    // AUTHOR
    Route::get('/author/home', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/author/create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/author/store', [AuthorController::class, 'store'])->name('author.store');
    Route::get('/author/edit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::post('/authorstatus/{id}', [AuthorController::class, 'status'])->name('author.status');
    // Route::post('/authorstatus/{id}', function ($id) {
    //     dd('Route reached');
    // });
    Route::post('/author/update/{id}', [AuthorController::class, 'update'])->name('author.update');
    Route::get('/author/delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');


    // ROLE
    Route::get('/role/home', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('/role/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');

    // PERMISSION
    Route::get('/permission/home', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permissioncreate', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permissionstore', [PermissionController::class, 'store'])->name('permission.store');

    // USER
    Route::get('/user/home', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/userstatus/{id}', [UserController::class, 'status'])->name('user.status');
    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    // PAGES
    Route::get('/page/home', [PageController::class, 'index'])->name('page.index');
    Route::get('/page/create', [PageController::class, 'create'])->name('page.create');
    Route::post('/page/store', [PageController::class, 'store'])->name('page.store');
    Route::get('/page/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
    Route::put('/page/update/{id}', [PageController::class, 'update'])->name('page.update');
    Route::get('/page/delete/{id}', [PageController::class, 'delete'])->name('page.delete');
    Route::post('/pagestatus/{id}', [PageController::class, 'status'])->name('page.status');

    // SEO
    Route::get('/seo/index', [SeoController::class, 'index'])->name('seo.index');
    Route::get('/seofield/create', [SeoController::class, 'create'])->name('seo.fieldcreate');
    Route::post('/seofield/store', [SeoController::class, 'store'])->name('seo.fieldstore');
    Route::get('seofield/edit/{id}',[SeoController::class,'fieldedit'])->name('seo.fieldedit');
    Route::post('seofield/update',[SeoController::class,'fieldupdate'])->name('seo.fieldupdate');
    Route::put('/seo/update', [SeoController::class, 'update'])->name('seo.update');
    Route::get('seo/delete/{id}', [SeoController::class, 'delete'])->name('seo.delete');


    // TESTIMONIAL
    Route::get('/testimonial/index', [TestimonialController::class, 'index'])->name('testimonial.index');
    Route::get('/testimonial/create', [TestimonialController::class, 'create'])->name('testimonial.create');
    Route::post('/testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store');
    Route::get('/testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
    Route::put('/testimonial/update/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::post('/testimonial/statusUpdate/{id}', [TestimonialController::class, 'statusUpdate'])->name('testimonial.statusUpdate');
    Route::get('/testimonial/delete/{id}', [TestimonialController::class, 'delete'])->name('testimonial.delete');


    // PARTNERS
    Route::get('/partner/index', [PartnerController::class, 'index'])->name('partner.index');
    Route::get('/partner/create', [PartnerController::class, 'create'])->name('partner.create');
    Route::post('/partner/store', [PartnerController::class, 'store'])->name('partner.store');
    Route::get('/partner/edit/{id}', [PartnerController::class, 'edit'])->name('partner.edit');
    Route::put('/partner/update/{id}', [PartnerController::class, 'update'])->name('partner.update');
    Route::post('/partner/statusUpdate/{id}', [PartnerController::class, 'statusUpdate'])->name('partner.statusUpdate');
    Route::get('/partner/delete/{id}', [PartnerController::class, 'delete'])->name('partner.delete');

    // SLIDERS
    Route::get('/slider/index', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::put('/slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::post('/slider/statusUpdate/{id}', [SliderController::class, 'statusUpdate'])->name('slider.statusUpdate');
    Route::get('/slider/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');


// ERROR
    Route::get('/error', [ErrorController::class, 'showError'])->name('logger.error');
});




// FRONTEND

// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
