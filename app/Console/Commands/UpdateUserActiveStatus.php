<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateUserActiveStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-user-active-status';

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
        $users = User::where('user_group_id', '2')
        ->whereRaw('DATEDIFF(NOW(), update_date) > 10')
        ->get();

        if(count($users) > 0){
            foreach($users as $user){
                $user->active_status = '0';
                $user->update();
            }
            $this->info('user active statuses updated successfully.');
        }else{
            $this->info('No data found.');
        }
        
    }
}
