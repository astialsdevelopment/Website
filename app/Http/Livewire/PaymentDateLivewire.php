<?php

namespace App\Http\Livewire;

use App\Models\PaymentDate;
use Livewire\Component;

class PaymentDateLivewire extends Component
{
    public $id2;
    public function render()
    {

        $sw = PaymentDate::where('customers.id','=',$this->id2)
        ->join('customers','customers.name','=','payment_dates.customer')
        ->join('orders','orders.id','=','payment_dates.invoice')
        ->select('payment_dates.*','orders.bike_name as two_wheeler')
        ->latest()
        ->get();
        return view('livewire.payment-date-livewire')->with([
            'dates'=>$sw,
        ]);
    }
}
