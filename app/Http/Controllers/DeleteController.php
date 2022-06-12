<?php

namespace App\Http\Controllers;

use App\Models\Bikes;
use App\Models\Order_no;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function delete_bike()
    {
        Bikes::where('id','=',request()->id)->delete();
        session()->flash('done2', 'SuccessFully <b>Deleted</b>');
        return redirect()->back()->withInput();
    }
    public function delete_order_no()
    {
        Order_no::where('id', '=', request()->id)->delete();
        $po = Order_no::where('id', '=', request()->id)->first()->order_no;
        UserOrder::where('order_no','=',$po)->delete();
        session()->flash('done1', 'SuccessFully <b>Deleted</b>');
        return redirect()->back()->withInput();
    }
}
