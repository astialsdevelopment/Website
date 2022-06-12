<?php

namespace App\Http\Controllers;

use App\Models\Bikes;
use App\Models\Order_no;
use Illuminate\Http\Request;

class AddController extends Controller
{
    public function add_bike()
    {
        if (count(Bikes::where('bike_name', '=', request()->bike_name)->get()) !== 0){
            session()->flash('error2', '<b>Bike Name</b> Already Exists');    
        }
        if(count(Bikes::where('bike_name','=',request()->bike_name)->get()) == 0){
        Bikes::create(request()->all());
        session()->flash('done2', 'SuccessFully <b>ADDED</b>');
        }
        return redirect()->back();
    }
    public function add_order_no()
    {
        if (count(Order_no::where('order_no', '=', request()->order_no)->get()) !== 0){
            session()->flash('error1', '<b>Order No.</b> Already Exists');    
        }
        if (count(Order_no::where('order_no', '=', request()->order_no)->get()) == 0){
        Order_no::create(request()->all());
        session()->flash('done1', 'SuccessFully <b>ADDED</b>');
        }
        return redirect()->back();
    }
}
