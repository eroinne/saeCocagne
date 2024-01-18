<?php

namespace App\Console\Commands;

use App\Models\Depots;
use Illuminate\Console\Command;
use App\Models\TournerLivraison;

class CreateTournee extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create-tournee';

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
        // On Créer une tournée en jour_preparation lundi, et jour_livraison mercredi, on récupère les depot avec jour_livraison = mercredi
        $depots = Depots::where('jour_livraison', 'mercredi')->where('structures_id', 1)->get();

        $tournee = new TournerLivraison();

        $tournee->jour_preparation = 'lundi';
        $tournee->jour_livraison = 'mercredi';
        $tournee->point_depots = implode(';', $depots->pluck('id')->toArray());
        $tournee->structures_id = 1;
        $tournee->couleur = "red";

        $tournee->save();


    }
}
