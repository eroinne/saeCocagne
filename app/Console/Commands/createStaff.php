<?php

namespace App\Console\Commands;

use App\Models\Staffs;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class createStaff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-staff';

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
        // Change staff with id 3 password to 12345678
        $staff = Staffs::find(1);
        $staff->password = \Hash::make('12345678');
        $staff->save();
    }
}
