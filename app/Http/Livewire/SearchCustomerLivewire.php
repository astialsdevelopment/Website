<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class SearchCustomerLivewire extends Component
{
    public $search;
    public function render()
    {
        if ($this->search == null) {
            return view('livewire.search-customer-livewire')->with([
                'customer' => Customer::all(),
            ]);
        } else {
            return view('livewire.search-customer-livewire')->with([
                'customer' => Customer::where('name', 'LIKE', '%' . $this->search . '%')
                    ->Orwhere('mobile', 'LIKE', '%' . $this->search . '%')
                    ->Orwhere('address', 'LIKE', '%' . $this->search . '%')
                    ->get(),
            ]);
        }
    }
    public function search2()
    {
        $this->render();
    }
    public function delete($id)
    {
        Customer::where('id', '=', $id)->delete();
        session()->flash('done2', 'SuccessFully <b>Deleted</b>');
        $this->render();
    }
}
