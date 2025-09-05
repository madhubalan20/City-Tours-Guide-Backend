<?php

namespace App\Livewire\MapIcon;

use App\Models\MapIcon;
use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class MapIconDetail extends Component
{
    use WithFileUploads;

    public $mapicon;

    public $name, $icon, $marker_symbol;

    public $edit_id, $edit_name, $edit_icon, $edit_marker_symbol, $delete_id, $delete_name;

    public function render()
    {
        $this->mapicon = MapIcon::orderBy('id', 'desc')->get();

        return view('livewire.map-icon.map-icon-detail');
    }

    public function addIcon()
    {
        $this->validate([
            'name' => 'required',
            'marker_symbol' => 'required|string',
            'icon' => 'required|image|mimes:png,jpg,svg',
        ]);


        try {
            $new_icon = new MapIcon;
            $new_icon->name = $this->name;
            $new_icon->marker_symbol = $this->marker_symbol;
            
            if ($this->icon) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->icon->getClientOriginalExtension();
                $path = $this->icon->storeAs('mapicon', $imageName, 'public');
                $new_icon->icon = url("storage/" . $path);
            }
            $new_icon->save();

            $notification = array(
                'message' => 'Map Icon Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('map.icon.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('map.icon.detail')->with('error', $e->getMessage());
        }
    }

    public function editIcon($id)
    {
        $edit_icon = MapIcon::where('id', $id)->first();

        $this->edit_id = $edit_icon->id;
        $this->edit_name = $edit_icon->name;
        $this->edit_marker_symbol = $edit_icon->marker_symbol;

    }

    public function UpdateIcon()
    {
        $this->validate([
            'edit_name' => 'required',
            'edit_marker_symbol' => 'required|required',
        ]);

        if ($this->edit_icon) {
            $this->validate([
                'edit_icon' => 'required|image|mimes:png,jpg,svg',
            ]);
        }
        try {
            $update_icon = MapIcon::where('id', $this->edit_id)->first();

            $update_icon->name = $this->edit_name;
            $update_icon->marker_symbol = $this->edit_marker_symbol;
            
            if ($this->edit_icon) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->edit_icon->getClientOriginalExtension();
                $path = $this->edit_icon->storeAs('mapicon', $imageName, 'public');
                $update_icon->icon = url("storage/" . $path);
            }
            $update_icon->update();

            $notification = array(
                'message' => 'Map Icon Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('map.icon.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('map.icon.detail')->with('error', $e->getMessage());
        }
    }

    public function getDelete($id)
    {
        
        $delete_icon = MapIcon::where('id', $id)->first();

        $this->delete_id = $delete_icon->id;
        $this->delete_name = $delete_icon->name;

    }

    public function deleteIcon()
    {
        try {
            $delete_Icon = MapIcon::where('id', $this->delete_id)->first();
            $delete_Icon->delete();

            $notification = array(
                'message' => 'Map Icon Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('map.icon.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('map.icon.detail')->with('error', $e->getMessage());
        }

    }
}
