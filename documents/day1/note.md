<!-- Route : have 7 methods -->

<!-- Truyền biến lên Url -->
<!-- only GET -->

// Regular Expression in Route
Route::get('{cate}/{id}', function($cate, $id){
    return "Cate: ".$cate." Id: ".$id;
})->where('cate', '[0-9]');

<!-- only POST -->
create a form sample @csrf

Route::get('form', function () {
    return view('form');
});

Route::post('user/{id}', function($id){
    return 'Test Submit: '.$id;
});

<!-- only PUT (POST) -->
@csrf
@method('put')

Route::put('user/{id}', function($id){
    return 'Method PUT: '.$id;
});


<!-- only DELETE (POST) -->
@csrf
@method('put')

Route::delete('delete/{id}', function($id){
    return 'Method Delete: '.$id;
});


<!-- Route Options -->
Route::options('options', function(){
    return "Method Options";
});

// ------------------------- match --------------------------------
Use for 2 method which has the same 'URL' and return same result 

Route::match(['get', 'post'], 'profile', function () {
    return "Profile Infomation";
});



// ------------------------- Route->name --------------------------------
Route::get('name/{name}}/cate/{cate}', function($name, $cate){
    return "Name :". $name ." Cate: ". $cate;
})->name('show.name');


// ------------------------- Route::group --------------------------------
Manage route

// Backend
Route::prefix('backend')->group(function(){
    Route::get('user', function () {
        return 'Backend user';
    });

    Route::get('product', function () {
        return 'Backend product';
    });
});

<!-- Artisan Route : -->
php artisan route:list



<!-- ------------------------------------------------------------------------ -->

<!-- ------------------------------ MIDDLEWARE ------------------------------------------ -->
php artisan make:middleware TenMiddleWare

Go to app\Http\Kernel.php

protected $routeMiddleware = [
    ...,
    'test.middleware' => \App\Http\Middleware\TestMiddleWare::class,
]

test url : http://127.0.0.1:8000/backend/user?username=admin&password=pass