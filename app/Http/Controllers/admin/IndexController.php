<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        return view('adminIndex');
    }
}
