<?php

namespace App\Console\Commands;

use App\Models\TourPlace;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class UpdateFreeTour extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-free-tour';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {

            $today = Carbon::now()->format('Y-m-d');  // Get today's date
    
            $tours = TourPlace::where('free_tour_status', '=', '1')
                ->whereDate('free_tour_validate_date', '<=', $today)
                ->get();
    
            if (!$tours->isEmpty()) {

                foreach ($tours as $list) {

                    $list->free_tour_status = '0';
                    $list->free_tour_validate_date = null;  
                    $list->update(); 
                }
    
                $this->info('Free tour statuses updated successfully.');
            } else {
                $this->info('No free tour found.');
            }
        } catch (\Exception $e) {
            \Log::error('Error in app:update-expired-purchase command: ' . $e->getMessage());
            $this->error('Failed to update purchase statuses. Check logs for details.');
        }
    }
}
