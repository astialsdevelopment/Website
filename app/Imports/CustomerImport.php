<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use \Maatwebsite\Excel\Concerns\ToCollection;

class CustomerImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (count(Customer::where('mobile', '=', $row[1])->get()) !== 0) {
                session()->flash('error', 'This <b>Customer Mobile No. : ' . $row[1] . '</b> Already Exists.');
            }
            if (count(Customer::where('address', '=', $row[2])->get()) !== 0) {
                session()->flash('error', 'This <b>Customer Address : ' . $row[2] . '</b> Already Exists.');
            }
            if (strlen($row[1]) != 10) {
                session()->flash('error', 'This <b>Customer Mobile No. : ' . $row[1] . '</b> is Invalid.');
            }
            if (count(Customer::where('address', '=', $row[2])->get()) == 0 && count(Customer::where('mobile', '=', $row[1])->get()) == 0 && strlen($row[1]) == 10) {
                Customer::create([
                    'name' => $row[0],
                    'mobile' => $row[1],
                    'address' => $row[2],
                    'total_bill' => 0,
                ]);
                session()->flash('done2', 'Successfully Imported');
            }
        }
        // dd($rows);

    }
}
