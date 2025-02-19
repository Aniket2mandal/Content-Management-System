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

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    // USER
    Route::get('/userhome', [UserController::class, 'index'])->name('user.index');
    Route::get('/usercreate', [UserController::class, 'create'])->name('user.create');




    // CATEFORY
    Route::get('/categoryhome', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categorycreate', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categorystore', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categoryedit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/categoryupdate/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/categorystatus/{id}', [CategoryController::class, 'status'])->name('category.status');
    Route::get('/categorydelete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // POST

    Route::get('/posthome', [PostController::class, 'index'])->name('post.index');
    Route::get('/postcreate', [PostController::class, 'create'])->name('post.create');
    Route::post('/poststore', [PostController::class, 'store'])->name('post.store');
    Route::get('/postedit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/postupdate/{id}', [PostController::class, 'update'])->name('post.update');
    Route::post('/poststatus/{id}', [PostController::class, 'status'])->name('post.status');
    Route::get('/postdelete/{id}', [PostController::class, 'delete'])->name('post.delete');


    // AUTHOR
    Route::get('/authorhome', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/authorcreate', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/authorstore', [AuthorController::class, 'store'])->name('author.store');
    Route::get('/authoredit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::post('/authorstatus/{id}', [AuthorController::class, 'status'])->name('author.status');
    // Route::post('/authorstatus/{id}', function ($id) {
    //     dd('Route reached');
    // });
    Route::post('/authorupdate/{id}', [AuthorController::class, 'update'])->name('author.update');
    Route::get('/authordelete/{id}', [AuthorController::class, 'delete'])->name('author.delete');


    // ROLE
    Route::get('/rolehome', [RoleController::class, 'index'])->name('role.index');
    Route::get('/rolecreate', [RoleController::class, 'create'])->name('role.create');
    Route::post('/rolestore', [RoleController::class, 'store'])->name('role.store');
    Route::get('/roleedit/{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/roleupdate/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('/roledelete/{id}', [RoleController::class, 'delete'])->name('role.delete');

    // PERMISSION
    Route::get('/permissionhome', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permissioncreate', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permissionstore', [PermissionController::class, 'store'])->name('permission.store');

    // USER
    Route::get('/userhome', [UserController::class, 'index'])->name('user.index');
    Route::get('/usercreate', [UserController::class, 'create'])->name('user.create');
    Route::post('/userstore', [UserController::class, 'store'])->name('user.store');
    Route::get('/useredit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/userupdate/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/userstatus/{id}', [UserController::class, 'status'])->name('user.status');
    Route::get('/userdelete/{id}', [UserController::class, 'delete'])->name('user.delete');

    // PAGES
    Route::get('/pagehome', [PageController::class, 'index'])->name('page.index');
    Route::get('/pagecreate', [PageController::class, 'create'])->name('page.create');
    Route::post('/pagestore', [PageController::class, 'store'])->name('page.store');
    Route::get('/pageedit/{id}', [PageController::class, 'edit'])->name('page.edit');
    Route::put('/pageupdate/{id}', [PageController::class, 'update'])->name('page.update');
    Route::get('/pagedelete/{id}', [PageController::class, 'delete'])->name('page.delete');
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
