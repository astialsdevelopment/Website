<?php

namespace App\Http\Livewire;

use App\Models\PaymentDate;
use Livewire\Component;

class PaymentDateLivewire extends Component
{
    public $id2;
    public function render()
    {

        $sw = PaymentDate::where('customers.id', '=', $this->id2)
            ->join('customers', 'customers.name', '=', 'payment_dates.customer')
            ->select('payment_dates.*')
            ->latest()
            ->get();
        return view('livewire.payment-date-livewire')->with([
            'dates' => $sw,
        ]);
    }
}
