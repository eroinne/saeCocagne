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
        //Create a staffs
        $staff = new Staffs();
        $staff->nom = 'admin';
        $staff->prenom = 'admin';
        $staff->email = 'a@gmail.com';
        $staff->is_admin = true;
        $staff->structures_id = 1;
        $staff->password = \Hash::make('12345678');
        $staff->save();
    }
}
