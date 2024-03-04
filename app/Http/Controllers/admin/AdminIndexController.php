<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class AdminIndexController extends Controller
{
    public function index(){
        return view('adminIndex');
    }
}
