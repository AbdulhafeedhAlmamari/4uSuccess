<?php

namespace App\Http\Controllers;

class HouseController extends Controller
{
    public function index()
    {
        return view('houses.index');
    }

    public function show()
    {
        return view('houses.show');
    }
}
