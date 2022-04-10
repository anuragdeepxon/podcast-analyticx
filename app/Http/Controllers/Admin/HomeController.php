<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');

        // $this->middleware('log', ['only' => [
        //     'fooAction',
        //     'barAction',
        // ]]);

        // $this->middleware('auth', ['except' => [
        //     '/'
        // ]]);
    }

    public function index()
    {
        return view('home');
    }
}
