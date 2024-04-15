<?php

namespace App\Http\Controllers;

use App\Models\PricingStructure;
use Illuminate\Http\Request;

class PricingStructureController extends Controller
{
    public function index()
    {
        return view('pricingStructure.admin.index',['pricingStructures'=>PricingStructure::all()]);
    }

    public function create()
    {
        return view('pricingStructure.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'price'=>'required|numeric|min:0',
            'payment_frequency'=>'required|in:weekly,monthly,quarterly,biannually,annually',
            'frequency_multiplier'=>'nullable|numeric|min:0.01|default:1'
        ]);

        PricingStructure::create([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'payment_frequency'=>$request->input('payment_frequency'),
            'frequency_multiplier'=>$request->input('frequency_multiplier',1),
        ]);
        return redirect()->route('admin.pricing.index')->with('success',__('admin_created_successfully'));
    }

    public function edit(int $id)
    {
        return view('pricingStructure.admin.edit',['pricingStructure'=>PricingStructure::findOrFail($id)]);
    }

    public function update(Request $request, int $id)
    {
        $pricingStructure = PricingStructure::findOrFail($id);
        $request->validate([
            'name' => 'required|string|min:2',
            'price'=>'required|numeric|min:0',
            'payment_frequency'=>'required|in:weekly,monthly,quarterly,biannually,annually',
            'frequency_multiplier'=>'nullable|numeric|min:0.01'
        ]);

        $pricingStructure->update([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'payment_frequency'=>$request->input('payment_frequency'),
            'frequency_multiplier'=>$request->input('frequency_multiplier',1),
        ]);

        return redirect()->route('admin.pricing.index')->with('success',__('admin_updated_successfully'));

    }

    public function destroy(int $id){
        $pricing = PricingStructure::findOrFail($id);
        $pricing->delete();
        return back()->with('success',__('pricing.admin_deleted_successfully'));
    }

}
