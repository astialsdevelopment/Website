<?php

namespace App\Http\Livewire;

use App\Imports\CustomerImport;
use App\Models\Customer;
use Livewire\WithFileUploads;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class SearchCustomerLivewire extends Component
{
    use WithFileUploads;
    public $search;
    public $import_file;

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

    public function importData()
    {
        return Excel::import(new CustomerImport, $this->import_file);
        dd('s');
    }
}
