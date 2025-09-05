<?php

namespace App\Livewire\User;

use App\Models\Report;
use App\Models\ReportImage;
use Livewire\Component;

class ViewReportDetails extends Component
{

    public $userReports, $userReportsImage;

    public function render()
    {
        $this->id = request()->segment(3);

        $this->userReports = Report::where('id', $this->id)->first();

        $this->userReportsImage = ReportImage::where('report_id', $this->id)->get();


        return view('livewire.user.view-report-details');
    }
}
