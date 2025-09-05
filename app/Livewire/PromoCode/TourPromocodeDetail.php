<?php

namespace App\Livewire\PromoCode;

use App\Models\PromoCode;
use App\Models\TourPlace;
use App\Models\User;
use Exception;
use Livewire\Component;

class TourPromocodeDetail extends Component
{
    public $selecttour, $selectuser, $promocodelist, $coupon_code, $percentage, $maximum_discount_amount, $validate_date, $description,
    $minimum_order_amount, $flat_amount;

    public $edit_id, $edit_tour_name, $edit_coupon_code, $edit_percentage, $edit_maximum_discount_amount, $edit_validate_date, 
    $edit_description,$edit_minimum_order_amount, $edit_flat_amount, $delete_id, $edit_user_name;

    public $tour_name, $user_name;
    public function render()
    {
        $this->selecttour=TourPlace::where('status', '1')->get();
        $this->promocodelist = PromoCode::where('coupon_type', '1')->orderBy('id', 'desc')->get();
        $this->selectuser=User::where([['user_group_id', '2'],['delete_account_status','1']])->get();


        return view('livewire.promo-code.tour-promocode-detail');
    }

    public function addCoupon(){

        $this->validate([
            'coupon_code' => 'required|unique:promo_codes',
            'minimum_order_amount'=>'required|integer',
            'percentage' => 'required|integer',
            'maximum_discount_amount' => 'required|integer',
            'validate_date' => 'required',
        ]);

        try{
            
            $newCoupon = new PromoCode;
            $newCoupon->user_id = $this->user_name ? $this->user_name : null;
            $newCoupon->tour_id = $this->tour_name ? $this->tour_name : null;
            $newCoupon->coupon_type ='1';
            $newCoupon->coupon_code =$this->coupon_code;
            $newCoupon->minimum_order_amount =$this->minimum_order_amount;
            $newCoupon->percentage =$this->percentage;
            $newCoupon->maximum_discount_amount =$this->maximum_discount_amount;
            $newCoupon->flat_amount =$this->flat_amount;
            $newCoupon->validate_day =$this->validate_date;
            $newCoupon->description =$this->description;
    
            if($this->percentage > 0){
             $newCoupon->type ='precentage';
            }else{
                $newCoupon->type ='flat';
            }
            $newCoupon->save();        
            
            $notification = array(
                'message' => 'Promocode Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('promocode.tour.promocode')->with($notification);

        }catch(Exception $e){

            return redirect()->route('promocode.tour.promocode')->with('error', $e->getMessage());

        }
    }

    public function editTourPromocode($id)
    {
        $edit_promocode = PromoCode::where('id', $id)->first();

        $this->edit_id = $edit_promocode->id;
        $this->edit_user_name = $edit_promocode->user_id;
        $this->edit_tour_name = $edit_promocode->tour_id;
        $this->edit_coupon_code = $edit_promocode->coupon_code;
        $this->edit_percentage = $edit_promocode->percentage;
        $this->edit_maximum_discount_amount = $edit_promocode->maximum_discount_amount;
        $this->edit_minimum_order_amount = $edit_promocode->minimum_order_amount;
        $this->edit_flat_amount = $edit_promocode->flat_amount;
        $this->edit_validate_date = $edit_promocode->validate_day;
        $this->edit_description = $edit_promocode->description;
    }

    public function updateCoupon(){

        $this->validate([
            'edit_coupon_code' => 'required',
            'edit_percentage' => 'required|integer',
            'edit_maximum_discount_amount' => 'required|integer',
            'edit_minimum_order_amount' => 'required|integer',
            'edit_validate_date' => 'required',

        ]);

        try{
            
            $updateCoupon = PromoCode::where('id', $this->edit_id)->first();
    
            $updateCoupon->user_id =$this->edit_user_name ? $this->edit_user_name : null;
            $updateCoupon->tour_id =$this->edit_tour_name ? $this->edit_tour_name : null;
            $updateCoupon->coupon_code =$this->edit_coupon_code;
            $updateCoupon->percentage =$this->edit_percentage;
            $updateCoupon->maximum_discount_amount =$this->edit_maximum_discount_amount;
            $updateCoupon->minimum_order_amount =$this->edit_minimum_order_amount;
            $updateCoupon->flat_amount =$this->edit_flat_amount;
            $updateCoupon->validate_day =$this->edit_validate_date;
            $updateCoupon->description =$this->edit_description;

            if($this->edit_percentage > 0){
                $updateCoupon->type ='precentage';
               }else{
                   $updateCoupon->type ='flat';
               }
            $updateCoupon->update();
            
            $notification = array(
                'message' => 'Promocode Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('promocode.tour.promocode')->with($notification);

        }catch(Exception $e){

            return redirect()->route('promocode.tour.promocode')->with('error', $e->getMessage());

        }
    }

    public function updateStatus($value, $id)
    {

        try {
            $update = PromoCode::where('id', $id)->first();

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

            return redirect()->route('promocode.tour.promocode')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('promocode.tour.promocode')->with('error', $e->getMessage());
        }
    }

    public function getDeletePromocode($id)
    {
        $delete_promocode = PromoCode::where('id', $id)->first();
        $this->delete_id = $delete_promocode->id;
    }

    public function deletePromocode()
    {
        try {
            $delete_promo = PromoCode::where('id', $this->delete_id)->first();
            $delete_promo->delete();

            $notification = array(
                'message' => 'Promocode Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('promocode.tour.promocode')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('promocode.tour.promocode')->with('error', $e->getMessage());
        }
    }

    public function updateFlatValue(){

        $this->flat_amount=0;
        $this->edit_flat_amount=0;
    }

    public function updatePercentage(){

        $this->maximum_discount_amount=0;
        $this->percentage=0;
        $this->edit_maximum_discount_amount=0;
        $this->edit_percentage=0;
    }
}
