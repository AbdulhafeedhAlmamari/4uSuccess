<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;

class TransportController extends Controller
{
    public function index()
    {
        return view('transports.index');
    }

    public function show()
    {
        return view('transports.show');
    }

    public function search()
    {
        return view('transports.search');
    }

    public function searchResult()
    {
        return view('transports.search-result');
    }
}
