<?php

namespace App\Livewire\State;

use App\Models\Country as Countries;
use App\Models\State;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class StateList extends Component
{
    use WithFileUploads;

    public $selectcountry, $state_name, $country_name, $stateList, $state_id, $edit_state_name, $editcountry_name,
    $price, $image, $edit_image;

    public function render()
    {
        $this->selectcountry = Countries::where('status', '1')->orderBy('id', 'DESC')->get();

        $this->stateList = State::orderBy('id', 'DESC')->get();

        return view('livewire.state.state-list');
    }

   /*  public function addstate()
    {
        $this->validate([
            'state_name' => 'required|unique:states,name',
            'country_name' => 'required',
            'image' => 'required|image|max:1024|mimes:jpg,jpeg,png,gif',
        ], [
            'image.max' => 'The image must be less than 1 MB.'
        ]);

        try {
            $state = new State;
            $state->country_id = $this->country_name;
            $state->name = $this->state_name;
            $state->status = '1';

            if ($this->image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('stateimage', $imageName, 'public');
                $state->image = url("storage/" . $path);
            }
            $state->save();

            $notification = array(
                'message' => 'State Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('state.list')->with($notification);
        } catch (Exception $e) {
            return redirect()->route('state.list')->with('error', $e->getMessage());
        }

    } */

    public function updateStatus($value, $id)
    {

        try {
            $update = State::where('id', $id)->first();

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

            return redirect()->route('state.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('state.list')->with('error', $e->getMessage());
        }
    }

    /* public function updateRecommendStatus($value, $id)
    {

        try {
            $update = State::where('id', $id)->first();

            if ($value == true) {
                $update->recommend_status = '1';
            } else {
                $update->recommend_status = '0';
            }
            $update->save();

            $notification = array(
                'message' => 'Recommend Status Updated',
                'alert-type' => 'info'
            );

            return redirect()->route('state.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('state.list')->with('error', $e->getMessage());
        }
    } */

    public function edit($id)
    {
        $editState = State::where('id', $id)->first();

        if ($editState) {
            $this->state_id = $editState->id;
            $this->edit_state_name = $editState->name;
            $this->editcountry_name = $editState->country_id;
        }
    }

    public function updateState()
    {
        $this->validate([
            'editcountry_name' => 'required',
            'edit_state_name' => 'required',
        ]);

        try {
            $update_state = State::where('id', $this->state_id)->first();

            $update_state->name = $this->edit_state_name;
            $update_state->country_id = $this->editcountry_name;
            $update_state->save();

            $notification = array(
                'message' => 'State Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('state.list')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('state.list')->with('error', $e->getMessage());
        }
    }
}
