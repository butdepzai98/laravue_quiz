<!-- ----- BLADE VIEW -------- -->

@include()

@extends()

@yield('page.title')

@section('page.title')
    Daskboard
@endsection


<!-- ----- Migration -------- -->
Quản lý version Database
- thêm sửa xóa bảng -

1- Config Database
- Create table
    php artisan make:migration create_tablename_table

- Thực Thi:
    php artisan migrate

- Rollback Database
    php artisan make:rollback