<?php

namespace App\Livewire\CurrencyType;

use App\Models\CurrencyType;
use Exception;
use Livewire\Component;

class CurrencyTypeDetail extends Component
{
    public $name, $symbol, $currency_code, $currencytype;

    public $edit_id, $edit_name, $edit_symbol, $delete_id, $delete_name, $edit_currency_code;

    public function render()
    {
        $this->currencytype = CurrencyType::orderBy('id', 'desc')->get();

        return view('livewire.currency-type.currency-type-detail');
    }

    public function addCurrencyType()
    {
        $this->validate([
            'name' => 'required',
            'symbol' => 'required',
            'currency_code' => 'required',
        ]);

        try {
            $new_symbol = new CurrencyType;
            $new_symbol->name = $this->name;
            $new_symbol->symbol = $this->symbol;
            $new_symbol->code = $this->currency_code;
            $new_symbol->save();

            $notification = array(
                'message' => 'Currency Type Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('currency.type.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('currency.type.detail')->with('error', $e->getMessage());
        }
    }

    public function editCurrencyType($id)
    {
        $edit_currency = CurrencyType::where('id', $id)->first();

        $this->edit_id = $edit_currency->id;
        $this->edit_name = $edit_currency->name;
        $this->edit_symbol = $edit_currency->symbol;
        $this->edit_currency_code = $edit_currency->code;

    }

    public function updateCurrencyType()
    {
        $this->validate([
            'edit_name' => 'required',
            'edit_symbol' => 'required',
            'edit_currency_code' => 'required',
        ]);

        try {
            $update_symbol = CurrencyType::where('id', $this->edit_id)->first();
            $update_symbol->name = $this->edit_name;
            $update_symbol->symbol = $this->edit_symbol;
            $update_symbol->code = $this->edit_currency_code;
            
            $update_symbol->update();

            $notification = array(
                'message' => 'Currency Type Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('currency.type.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('currency.type.detail')->with('error', $e->getMessage());
        }
    }

    public function getDelete($id)
    {
        
        $delete_currencyType = CurrencyType::where('id', $id)->first();

        $this->delete_id = $delete_currencyType->id;
        $this->delete_name = $delete_currencyType->name;

    }

    public function deleteCurrencytype()
    {
        try {
            $delete_currency_type = CurrencyType::where('id', $this->delete_id)->first();
            $delete_currency_type->delete();

            $notification = array(
                'message' => 'Currency Type Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('currency.type.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('currency.type.detail')->with('error', $e->getMessage());
        }

    }

    public function updateStatus($value, $id)
    {

        try {
            $update = CurrencyType::where('id', $id)->first();

            if ($value == true) {
                $update->status = '1';
            } else {
                $update->status = '0';
            }
            $update->save();

            $notification = array(
                'message' => 'Status Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('currency.type.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('currency.type.detail')->with('error', $e->getMessage());
        }
    }
}
