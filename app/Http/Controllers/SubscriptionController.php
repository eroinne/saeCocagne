<?php

namespace App\Http\Controllers;

use App\Models\Abonnements;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //this is a controller for subscription of an adherent to a structure

    //add a new subscription
    /**
     * @param Request $request
     * @return string[]
     */
    public function store(Request $request){
        $request->validate([
            'id_structure' => 'required|interger',
            'id_adherent' => 'required|interger',
            'duree' => 'required|integer',
            'periodicite' => 'required|string|max:255',
            'type_abonnement' => 'required|string|max:255',
            'moyen_paiement' => 'required|string|max:255'
        ]);

        $subscription = new Abonnements();
        $subscription->id_structure = $request->id_structure;
        $subscription->id_adherent = $request->id_subscriber;
        $subscription->duree = $request->duration;
        $subscription->periodicite = $request->periodicity;
        $subscription->type_abonnement = $request->subscription_type;
        $subscription->moyen_paiement = $request->payment_method;
        $result = $subscription->save();
        //TODO change wen view is complete
        if($result){
            return ["Result"=>"Le abonement a bien été ajouté a l'utiliser $subscription->id_adherent"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

        //update a subscription

    /**
     * @param Request $request
     * @param $id
     * @return string[]
     */
    public function update(Request $request, $id){
        $request->validate([
            'id_structure' => 'required|interger',
            'id_adherent' => 'required|interger',
            'duree' => 'required|integer',
            'periodicite' => 'required|string|max:255',
            'type_abonnement' => 'required|string|max:255',
            'moyen_paiement' => 'required|string|max:255'
        ]);

        $subscription = Abonnements::find($id);
        $subscription->id_structure = $request->id_structure;
        $subscription->id_adherent = $request->id_subscriber;
        $subscription->duree = $request->duration;
        $subscription->periodicite = $request->periodicity;
        $subscription->type_abonnement = $request->subscription_type;
        $subscription->moyen_paiement = $request->payment_method;
        $result = $subscription->save();
        //TODO change wen view is complete
        if($result){
            return ["Result"=>"Le abonement de l'utilisateur $subscription->id_adherent a bien été modifié"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }

            //delete a subscription
    /**
     * @param $id
     * @return string[]
     */
    public function destroy($id){
        $subscription = Abonnements::find($id);
        $id_adherent = $subscription->id_adherent;
        $type_subscription = $subscription->type_abonnement;
        $result = $subscription->delete();
        //TODO change wen view is complete
        if($result){
            return ["Result"=>"L abonement $type_subscription  l'utilisateur $id_adherent  a bien été supprimé"];
        }else{
            return ["Result"=>"Operation failed"];
        }
    }
}

