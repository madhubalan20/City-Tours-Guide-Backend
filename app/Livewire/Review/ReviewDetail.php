<?php

namespace App\Livewire\Review;

use App\Models\Review;
use Exception;
use Livewire\Component;

class ReviewDetail extends Component
{
    public $reviewlist;

    public $name, $rating_value, $review_content;

    public $edit_id, $edit_name, $edit_rating_value, $edit_review_content, $delete_id;


    public function render()
    {
        $this->reviewlist = Review::orderBy('id', 'desc')->get();

        return view('livewire.review.review-detail');
    }

    public function addReview()
    {
        $this->validate([
            'name' => 'required',
            'rating_value' => 'required|integer',
            'review_content' => 'required',
        ]);

        try {
            $new_review = new Review;

            $new_review->name = $this->name;
            $new_review->rating_value = $this->rating_value;
            $new_review->review_content = $this->review_content;
           
            $new_review->save();

            $notification = array(
                'message' => 'Review Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('review.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('review.detail')->with('error', $e->getMessage());
        }
    }

    public function editReview($id)
    {
        $edit_review = Review::where('id', $id)->first();

        $this->edit_id = $edit_review->id;
        $this->edit_name = $edit_review->name;
        $this->edit_rating_value = $edit_review->rating_value;
        $this->edit_review_content = $edit_review->review_content;
    }

    public function updateReview()
    {
        $this->validate([
            'edit_name' => 'required',
            'edit_rating_value' => 'required|integer',
            'edit_review_content' => 'required',
        ]);


        try {
            $update_review = Review::where('id', $this->edit_id)->first();

            $update_review->name = $this->edit_name;
            $update_review->rating_value = $this->edit_rating_value;
            $update_review->review_content = $this->edit_review_content;
            $update_review->save();

            $notification = array(
                'message' => 'Review Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('review.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('review.detail')->with('error', $e->getMessage());
        }
    }

    public function getDelete($id)
    {
        
        $delete_review = Review::where('id', $id)->first();

        $this->delete_id = $delete_review->id;
    }

    public function deleteReview()
    {
        try {
            $delete_Review = Review::where('id', $this->delete_id)->first();
            $delete_Review->delete();

            $notification = array(
                'message' => 'Review Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('review.detail')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('review.detail')->with('error', $e->getMessage());
        }

    }
}
