<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function publicIndex(){
        return view('locations.public.index',['locations'=>Location::all()]);
    }

    public function publicShow(int $id){
        return view('locations.public.show',['location'=>Location::findOrFail($id)]);
    }
}
