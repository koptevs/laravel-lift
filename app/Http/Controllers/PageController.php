<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public $name = "Igor";

    public function index()
    {
        return view('page', ['name' => $this->name]);
    }
}
