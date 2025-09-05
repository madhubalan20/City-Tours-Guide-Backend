<?php

namespace App\Livewire\Article;

use App\Models\TourArticle;
use App\Models\TourPlace;
use Exception;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class TourRelatedArticle extends Component
{
    use WithFileUploads;

    public $selecttour, $tourarticle;

    public $tour_name, $image, $title, $url, $description;

    public $edit_id, $edit_tour_name, $edit_image, $edit_title, $edit_url, $edit_description;

    public $delete_id, $delete_title;


    public function render()
    {
        $this->selecttour = TourPlace::where('status', '1')->get();
        $this->tourarticle = TourArticle::orderBy('id', 'desc')->get();

        return view('livewire.article.tour-related-article');
    }

    public function addArticle()
    {
        $this->validate([
            'tour_name' => 'required',
            'title' => 'required|string',
            'image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
            'url' => 'required|url',
        ], [
            'image.max' => 'The image must be less than 2 MB.'
        ]);

        try {
            $new_article = new TourArticle;

            $new_article->tour_id = $this->tour_name;
            $new_article->title = $this->title;
            $new_article->url = $this->url;
            $new_article->description = $this->description;
           
            if ($this->image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->image->getClientOriginalExtension();
                $path = $this->image->storeAs('tourarticleimage', $imageName, 'public');
                $new_article->image = url("storage/" . $path);
            }

            $new_article->save();

            $notification = array(
                'message' => 'Tour Article Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('tour.article')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour.article')->with('error', $e->getMessage());
        }
    }

    public function updateStatus($value, $id)
    {

        try {
            $update = TourArticle::where('id', $id)->first();

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

            return redirect()->route('tour.article')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour.article')->with('error', $e->getMessage());
        }
    }

    public function editTourArticle($id)
    {
        $edit_article = TourArticle::where('id', $id)->first();

        $this->edit_id = $edit_article->id;
        $this->edit_tour_name = $edit_article->tour_id;
        $this->edit_title = $edit_article->title;
        $this->edit_url = $edit_article->url;
        $this->edit_description = $edit_article->description;
    }

    public function updateTourArticle()
    {
        $this->validate([
            'edit_title' => 'required|string',
            'edit_tour_name' => 'required',
            'edit_url' => 'required|url',
            'edit_description' => 'required',
        ]);

        if ($this->edit_image) {
            $this->validate([
                'edit_image' => 'required|image|max:2048|mimes:jpg,jpeg,png,gif',
            ], [
                'edit_image.max' => 'The image must be less than 2 MB.'
            ]);
        }

        try {
            $update_article = TourArticle::where('id', $this->edit_id)->first();

            $update_article->title = $this->edit_title;
            $update_article->tour_id = $this->edit_tour_name;
            $update_article->url = $this->edit_url;
            $update_article->description = $this->edit_description;

            if ($this->edit_image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $this->edit_image->getClientOriginalExtension();
                $path = $this->edit_image->storeAs('tourarticleimage', $imageName, 'public');
                $update_article->image = url("storage/" . $path);
            }

            $update_article->update();

            $notification = array(
                'message' => 'Tour Article Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('tour.article')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour.article')->with('error', $e->getMessage());
        }
    }

    public function getDelete($id)
    {
        
        $delete_article = TourArticle::where('id', $id)->first();

        $this->delete_id = $delete_article->id;
        $this->delete_title = $delete_article->title;
    }

    public function deleteTourArticle()
    {
        try {
            $delete_tour_article = TourArticle::where('id', $this->delete_id)->first();
            $delete_tour_article->delete();

            $notification = array(
                'message' => 'Tour Article Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('tour.article')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('tour.article')->with('error', $e->getMessage());
        }

    }
}
