<!-- ------------------- Pagination ------------------------ -->
-1:

<div class="row">
    <div class="col-lg-12 d-flex justify-content-center">
        {{ $exams->links() }}
    </div>
</div>

-2: Go to app\Providers\AppServiceProvider.php

/**
    * Bootstrap any application services.
    *
    * @return void
*/
public function boot()
{
    Paginator::useBootstrap();
}