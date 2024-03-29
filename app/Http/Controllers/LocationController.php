<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    //Public
    public function publicIndex(){
        return view('locations.public.index',['locations'=>Location::all()]);
    }

    public function publicShow(int $id){
        return view('locations.public.show',['location'=>Location::findOrFail($id)]);
    }

    //Admin
    public function create()
    {
        return view('locations.admin.create');
    }

    public function store(Request $request){
        $request->validate([
            'short_description' => 'required|string|min:2',
            'long_description'=>'string',
            'name' => 'required|string|min:2',
            'cover_img_path'=>'nullable|image|mimes:jpeg,png|max:2048',
            'street_number' =>'string|required',
            'street_name' => 'string|required',
            'zip_code'=> 'string|required',
            'city'=>'string|required',
            'country'=>'string|required'
        ]);
        $address = Address::create([
            'street_number'=>$request->input('street_number'),
            'street_name'=>$request->input('street_name'),
            'zip_code'=>$request->input('zip_code'),
            'city'=>$request->input('city'),
            'country'=>$request->input('country'),
        ]);

        if ($request->hasFile('cover_img_path')) {
            $uploadedFile = $request->file('cover_img_path');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
            $uploadedFile->storeAs('public/location/images', $fileName); // Updated path
        }
        else {
            $uploadedFile = null;
        }

        Location::create([
            'short_description'=>$request->input('short_description'),
            'long_description' => $request->input('long_description'),
            'name'=>$request->input('name'),
            'cover_img_path' => 'storage/location/images/' .$fileName,
            'address_id' => $address->id
        ]);

        return redirect()->route('admin.locations.index')->with('success', 'Location created successfully');

    }
    public function edit(int $id)
    {
        return view('locations.admin.edit',['location'=>Location::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $location = Location::findOrFail($id);
        $address = $location->address;
        $request->validate([
            'short_description' => 'required|string|min:2',
            'long_description'=>'string',
            'name' => 'required|string|min:2',
            'cover_img_path'=>'nullable|image|mimes:jpeg,png|max:2048',
            'street_number' =>'string|required',
            'street_name' => 'string|required',
            'zip_code'=> 'string|required',
            'city'=>'string|required',
            'country'=>'string|required'
        ]);

        $address->update([
            'street_number'=>$request->input('street_number'),
            'street_name'=>$request->input('street_name'),
            'zip_code'=>$request->input('zip_code'),
            'city'=>$request->input('city'),
            'country'=>$request->input('country'),
        ]);

        if ($request->hasFile('cover_img_path')) {
            $uploadedFile = $request->file('cover_img_path');
            $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
            $uploadedFile->storeAs('public/location/images', $fileName); // Updated path
        }
        else {
            $uploadedFile = null;
        }

        $location->update([
            'short_description'=>$request->input('short_description'),
            'long_description' => $request->input('long_description'),
            'name'=>$request->input('name'),
            'cover_img_path' => 'storage/location/images/' .$fileName,
        ]);

        return redirect()->route('admin.locations.index')->with('success', 'Location updated successfully');


    }
    public function destroy(int $id)
    {
        Location::destroy($id);
        return back()->with('success','Location deleted');

    }

    public function index() //For admins
    {
        return view('locations.admin.index',['locations'=>Location::all()]);
    }
}
