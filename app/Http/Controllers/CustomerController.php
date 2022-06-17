<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function add_customer()
    {
        if (count(Customer::where('mobile', '=', request()->mobile)->get()) !== 0) {
            session()->flash('error3', 'This <b>Customer Mobile No.</b> Already Exists.');
        }
        if (count(Customer::where('address', '=', request()->address)->get()) !== 0) {
            session()->flash('error4', 'This <b>Customer Address</b> Already Exists.');
        }
        if (strlen(request()->mobile) != 10) {
            session()->flash('error5', 'This <b>Customer Mobile No.</b> is Invalid.');
        }
        if (count(Customer::where('address', '=', request()->address)->get()) == 0 && count(Customer::where('mobile', '=', request()->mobile)->get()) == 0 && strlen(request()->mobile) == 10) {
            Customer::create(request()->all());
            session()->flash('done3', 'The Customer Successfully Inserted.');
        }
        return redirect()->back()->withInput();
    }

    public function delete_customer()
    {
        Customer::where('id', '=', request()->id)->delete();
        session()->flash('done3', 'SuccessFully <b>Deleted</b>');
        return redirect()->back()->withInput();
    }
}
