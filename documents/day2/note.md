<!-- Controller -->
php artisan make:controller ProductController

------------------------ BUG --------------------------
- 2: Goto app/Http/Providers/RouteServiceProvider.php 
add it under: 
    public const HOME = '/home';

protected $namespace = 'App\Http\Controllers';


------ Add namespace for Route::namespace('nameFolder')
// Backend
Route::namespace('Backend')->prefix('backend')->group(function(){
    Route::get('user', function () {
        return 'Backend user';
    })->middleware('test.middleware', 'verify.middleware');
    

    Route::get('/', 'DaskboardController@index');
});

-------------------------------------------------------



<!-- VIEW -->

class ProductController extends Controller
{
    public function index()
    {
        $vinh = [
            'name' => 'Nguyen Xuan Vinh',
            'job' => 'developer',
            'age' => 23
        ];

        return view('backend.products.index',
            [
               'vinh' => $vinh,
            ]
        );
    }
}


<!-- MiddleWare in Controller -->

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('test.middleware')->except('index');
    }
}