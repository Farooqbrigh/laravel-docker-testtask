<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class everyMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'counter:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User table counter set to 0';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::get();
        if($users){
            foreach ($users as $key => $item) {
                $item->counter = 0;
                $item->save();
            }
        }
        echo 'Counter updated successfully';
    }
}
