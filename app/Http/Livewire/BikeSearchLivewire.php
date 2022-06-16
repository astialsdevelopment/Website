<?php

namespace App\Http\Livewire;

use App\Models\Bikes;
use Livewire\Component;

class BikeSearchLivewire extends Component
{
    public $search;
    public function render()
    {
        if ($this->search == "") {
            return view('livewire.bike-search-livewire')->with([
                'bikes' => Bikes::all(),
            ]);
        } else {
            return view('livewire.bike-search-livewire')->with([
                'bikes' => Bikes::where('bike_name', 'LIKE', '%' . $this->search . '%')->get(),
            ]);
        }
    }
    public function search2()
    {
        $this->render();
    }
    public function delete($id)
    {
        Bikes::where('id', '=', $id)->delete();
        session()->flash('done2', 'SuccessFully <b>Deleted</b>');
        $this->render();
    }
}
