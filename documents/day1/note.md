<!-- Route -->

<!-- Truyền biến lên Url -->
Route::get('{slug}', function($slug){
    return "Test: ".$slug;
}); 

Route::get('{cate}/{id}', function($cate, $id){
    return "Cate: ".$cate." Id: ".$id;
});