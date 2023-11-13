<?php

namespace App\Console\Commands;

use App\Models\Adherents;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class createUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-user';

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
        //get the user with id 1 and hash this password: 12345678
        $user = Adherents::find(1);
        dd(Hash::make('12345678'));
        $user->password = \Hash::make('12345678');
        $user->save();
    }
}
