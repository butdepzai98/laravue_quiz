<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('test.middleware')->except('index');
    }

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

    public function product($id)
    {
        return "ProductID :". $id;
    }

    public function create()
    {
        return view('backend.products.detail');
    }
}
