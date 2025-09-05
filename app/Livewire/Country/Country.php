<?php

namespace App\Livewire\Country;

use Exception;
use App\Models\Country as Countries;
use Livewire\Component;

class Country extends Component
{

    public $countrylist, $country_name, $edit_country_name, $country_id;

    public function render()
    {
        $this->countrylist = Countries::all();

        return view('livewire.country.country');
    }

    /* public function addcountry()
    {
        $this->validate([
            'country_name' => 'required|unique:countries,name',
        ]);

        try {
            $addCountry = new Countries;
            $addCountry->name = $this->country_name;
            $addCountry->status = '1';
            $addCountry->save();

            $notification = array(
                'message' => 'Country Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('country.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('country.list')->with('error', $e->getMessage());
        }
    } */

    public function updateStatus($value, $id)
    {
        try {
            $updateStatus = Countries::where('id', $id)->first();

            if ($value == true) {
                $updateStatus->status = '1';
            } else {
                $updateStatus->status = '0';
            }

            $updateStatus->save();

            $notification = array(
                'message' => 'Status Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('country.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('country.list')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $editCountry = Countries::where('id', $id)->first();

        if ($editCountry) {
            $this->edit_country_name = $editCountry->name;
            $this->country_id = $editCountry->id;
        }
    }

    public function update()
    {
        $this->validate([
            'edit_country_name' => 'required',
        ]);

        try {

            $updateCountry = Countries::where('id', $this->country_id)->first();
            $updateCountry->name = $this->edit_country_name;
            $updateCountry->save();

            $notification = array(
                'message' => 'Country Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('country.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('country.list')->with('error', $e->getMessage());
        }
    }
}
