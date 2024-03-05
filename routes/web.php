<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/icon', function () {

    //得到每一个url，获取其中的icon
              // $url = $matches[1][$i];
// header('Content-type: image/x-icon');
        $url = "https://www.jd.com";


        $contents = @file_get_contents($url); 
        
        preg_match('/<link .*?icon.*?href=(.*?).*/', $contents,$icons);


        if(!is_array($icons)) {
            preg_match('/<link .*?href=(.*?).*?icon.*/', $contents,$icons);
        }
        $icon = [];
        if(count($icons) > 0){
            preg_match('/href="(.*?)"/', $icons[0],$icon);
        }


        // dd($icon);

        // dd($icons,$icon);
        echo "<img src='{$icon[1]}'>";
        die;


});

use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');



use App\Http\Controllers\Admin\AuthController;
Route::group(['namespace'=>'Admin'], function() {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});



use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\SystemController;
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    Route::get('/', [IndexController::class, 'index'])->name('admin.index');


    // Route::get('category', [CategoryController::class, 'index'])->name('admin.category.index');


    // Route::get('site', [SiteController::class, 'index'])->name('admin.site.index');

    Route::get('system', [SystemController::class, 'index'])->name('admin.system.index');
    Route::post('system', [SystemController::class, 'store'])->name('admin.system.store');

    $controllers = [
        'category'  =>  CategoryController::class,
        'site'      =>  SiteController::class,
    ];

    $controller = strtolower(Request::segment(2));
    $action = strtolower(Request::segment(3));




    // if(isset($controllers[$controller])) {
    //     Route::resource($controller, $controllers[$controller],[
    //         'only'  =>  ['index', 'create', 'store', 'edit', 'update', 'destroy']
    //     ])->names('admin.'.$controller);
    // }
    //  else {
        foreach($controllers as $key => $value) {
            Route::resource($key, $value, [
                'only'  =>  ['index', 'create', 'store', 'edit', 'update', 'destroy']
            ])->names('admin.'.$key);
        }
    // }
});

