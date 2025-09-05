<?php

namespace App\Livewire\User;

use App\Models\ReportImage;
use App\Models\User;
use Exception;
use Livewire\Component;
use App\Models\Report as ModelsReport;

class Report extends Component
{

    public $userReports, $delete_id, $user_name;

    public function render()
    {

        $this->userReports = ModelsReport::orderBy('id', 'desc')->select('id', 'user_id', 'type', 'problem_type', 'create_date')->get();

        return view('livewire.user.report');
    }

    public function getDeleteReport($id)
    {
        $get_delete = ModelsReport::where('id', $id)->first();

        $get_user = User::where('id', $get_delete->user_id)->select('name')->first();

        $this->delete_id = $get_delete->id;
        $this->user_name = $get_user->name;
    }

    public function deleteReport()
    {
        try {

            $delete_image = ReportImage::where('report_id', $this->delete_id)-> get();

            if(count($delete_image) > 0){
                foreach( $delete_image as $image){
                    $image->delete();
                }
            }

            $delete_report = ModelsReport::where('id', $this->delete_id)->first();
            $delete_report->delete();

            $notification = array(
                'message' => 'User Report Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('user.reports')->with($notification);

        } catch (Exception $e) {
            return redirect()->route('user.reports')->with('error', $e->getMessage());
        }

    }
}
