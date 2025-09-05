<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\IntroBanner;
use App\Models\TopBottomBanner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function getBanner(Request $request){

        $banner = TopBottomBanner::where([['status', '1'], ['position', '1']])->orderBy('arrangement', 'asc')->get();

        if(count($banner) > 0){

            foreach($banner as $bannerlist){

                $dataObj = new \stdClass();

                $dataObj->banner_id=$bannerlist->id;

                if($bannerlist->file_type == 1){
                    $dataObj->banner_type='image';
                }else{
                    $dataObj->banner_type='video';
                }

                if($bannerlist->position == 1){
                    $dataObj->banner_position='top';
                }else{
                    $dataObj->banner_position='bottom';
                }

                $dataObj->banner_title=$bannerlist->title;
                $dataObj->banner_url=$bannerlist->image ?? null;
                $dataObj->banner_video_url=$bannerlist->vedio_url ?? null;

                if($bannerlist->url == null && $bannerlist->city_id == null && $bannerlist->tour_id == null){
                    $dataObj->redirect_type = '4';
                }else{
                    $dataObj->redirect_type = $bannerlist->type;
                }

                $dataObj->redirect_url = $bannerlist->url ?? null;
                $dataObj->city_id = $bannerlist->city_id ?? null;
                $dataObj->tour_id = $bannerlist->tour_id ?? null;
                $dataObj->banner_content = $bannerlist->description ?? null;

                $data[] = $dataObj; 
            }

            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
        }else{
            return response()->json(['message' => 'No Data Found', 'status' => false, 'code' => 404], 404);
        }
    }

    public function getBottomBanner(Request $request){

        $banner = TopBottomBanner::where([['status', '1'], ['position', '2']])->orderBy('arrangement', 'asc')->get();

        if(count($banner) > 0){

            foreach($banner as $bannerlist){

                $dataObj = new \stdClass();

                $dataObj->banner_id=$bannerlist->id;

                if($bannerlist->file_type == 1){
                    $dataObj->banner_type='image';
                }else{
                    $dataObj->banner_type='video';
                }

                if($bannerlist->position == 1){
                    $dataObj->banner_position='top';
                }else{
                    $dataObj->banner_position='bottom';
                }

                $dataObj->banner_title=$bannerlist->title;
                $dataObj->banner_url=$bannerlist->image ?? null;
                $dataObj->banner_video_url=$bannerlist->vedio_url ?? null;

                if($bannerlist->url == null && $bannerlist->city_id == null && $bannerlist->tour_id == null){
                    $dataObj->redirect_type = '4';
                }else{
                    $dataObj->redirect_type = $bannerlist->type;
                }

                $dataObj->redirect_url = $bannerlist->url ?? null;
                $dataObj->city_id = $bannerlist->city_id ?? null;
                $dataObj->tour_id = $bannerlist->tour_id ?? null;
                $dataObj->banner_content = $bannerlist->description ?? null;

                $data[] = $dataObj; 
            }

            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);
        }else{
            return response()->json(['message' => 'No Banner Found', 'status' => false, 'code' => 404], 404);
        }
    }

    public function getIntroBanner(Request $request){

        $intro_banner = IntroBanner::where('status', '1')->get();

        if(count($intro_banner) > 0){

            foreach($intro_banner as $bannerlist){

                $dataObj = new \stdClass();

                $dataObj->banner_id=$bannerlist->id;
                $dataObj->banner_title=$bannerlist->title;
                $dataObj->banner_url=$bannerlist->image;
                $dataObj->banner_content = $bannerlist->description ?? null;
                
                $data[] = $dataObj; 
            }

            return response()->json(['data' => $data, 'message' => 'Ok', 'status' => true, 'code' => 200], 200);

        }else{
            return response()->json(['message' => 'No Banner Found', 'status' => false, 'code' => 404], 404);
        }
    }
}
