<?php

namespace App\Livewire\AudioType;

use App\Models\AudioType;
use Exception;
use Livewire\Component;

class AudioTypeDetail extends Component
{
    public $language_name, $language_code, $audiolanguage, $edit_id, $edit_language_name, $edit_language_code, $delete_id, $delete_language_name;

    public function render()
    {
        $this->audiolanguage = AudioType::orderBy('id', 'desc')->get();

        return view('livewire.audio-type.audio-type-detail');
    }

    public function addLanguageType()
    {
        $this->validate([
            'language_name' => 'required',
            'language_code' => 'required',
        ]);

        try {
            $new_audio_language = new AudioType;
            $new_audio_language->name = $this->language_name;
            $new_audio_language->lang_code = $this->language_code;
            $new_audio_language->save();

            $notification = array(
                'message' => 'Audio Language Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('audio.type.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('audio.type.detail')->with('error', $e->getMessage());
        }
    }

    public function editLanguageType($id)
    {
        $edit_language = AudioType::where('id', $id)->first();

        $this->edit_id = $edit_language->id;
        $this->edit_language_name = $edit_language->name;
        $this->edit_language_code = $edit_language->lang_code;

    }

    public function updateLanguageType()
    {
        $this->validate([
            'edit_language_name' => 'required',
        ]);

        try {
            $update_language = AudioType::where('id', $this->edit_id)->first();

            $update_language->name = $this->edit_language_name;
            $update_language->lang_code = $this->edit_language_code;
            $update_language->update();

            $notification = array(
                'message' => 'Audio Language Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('audio.type.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('audio.type.detail')->with('error', $e->getMessage());
        }
    }

    public function getDelete($id)
    {
        
        $delete_language = AudioType::where('id', $id)->first();

        $this->delete_id = $delete_language->id;
        $this->delete_language_name = $delete_language->name;

    }

    public function deleteLanguagetype()
    {
        try {
            $delete_audio_language = AudioType::where('id', $this->delete_id)->first();
            $delete_audio_language->delete();

            $notification = array(
                'message' => 'Audio Language Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('audio.type.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('audio.type.detail')->with('error', $e->getMessage());
        }

    }

    public function updateStatus($value, $id)
    {

        try {
            $update = AudioType::where('id', $id)->first();

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

            return redirect()->route('audio.type.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('audio.type.detail')->with('error', $e->getMessage());
        }
    }
}
