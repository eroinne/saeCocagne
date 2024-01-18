<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Abonnements;
use Illuminate\Http\Request;
/**
 * @OA\Tag(
 *     name="Abonnements",
 *     description="API Endpoints of Subscriptions Controller"
 * )
 * Class SubscriptionController
 * @package App\Http\Controllers\Api
 */
class SubscriptionController extends Controller
{
    // Controller for managing subscriptions of an adherent to a structure

    /**
     * Add a new subscription
     *
     * @OA\Post(
     *     path="/api/abonnement",
     *     summary="Add a new subscription",
     *     tags={"Abonnements"},
     *     description="Add a new subscription for an adherent to a structure",
     *     operationId="addNewSubscription",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_structure", "id_adherent", "duree", "periodicite", "type_abonnement", "moyen_paiement"},
     *             @OA\Property(property="id_structure", type="integer"),
     *             @OA\Property(property="id_adherent", type="integer"),
     *             @OA\Property(property="duree", type="integer"),
     *             @OA\Property(property="periodicite", type="string", maxLength=255),
     *             @OA\Property(property="type_abonnement", type="string", maxLength=255),
     *             @OA\Property(property="moyen_paiement", type="string", maxLength=255),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *     ),
     *     @OA\Response(response=404, description="Operation failed")
     * )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_structure' => 'required|integer',
            'id_adherent' => 'required|integer',
            'duree' => 'required|integer',
            'periodicite' => 'required|string|max:255',
            'type_abonnement' => 'required|string|max:255',
            'moyen_paiement' => 'required|string|max:255'
        ]);

        $subscription = new Abonnements();
        $subscription->id_structure = $request->id_structure;
        $subscription->id_adherent = $request->id_adherent;
        $subscription->duree = $request->duree;
        $subscription->periodicite = $request->periodicite;
        $subscription->type_abonnement = $request->type_abonnement;
        $subscription->moyen_paiement = $request->moyen_paiement;
        $result = $subscription->save();

        // TODO change when view is complete
        if ($result) {
            return response()->json(["Result" => "La souscription a bien été ajoutée à l'utilisateur $subscription->id_adherent"], 200);
        } else {
            return response()->json(["Result" => "Operation failed"], 404);
        }
    }

    /**
     * Update a subscription
     *
     * @OA\Put(
     *     path="/api/abonnement/{id}",
     *     summary="Update a subscription",
     *     tags={"Abonnements"},
     *     description="Update details of a subscription by ID",
     *     operationId="updateSubscription",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the subscription to update",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_structure", "id_adherent", "duree", "periodicite", "type_abonnement", "moyen_paiement"},
     *             @OA\Property(property="id_structure", type="integer"),
     *             @OA\Property(property="id_adherent", type="integer"),
     *             @OA\Property(property="duree", type="integer"),
     *             @OA\Property(property="periodicite", type="string", maxLength=255),
     *             @OA\Property(property="type_abonnement", type="string", maxLength=255),
     *             @OA\Property(property="moyen_paiement", type="string", maxLength=255),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *     ),
     *     @OA\Response(response=404, description="Operation failed")
     * )
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_structure' => 'required|integer',
            'id_adherent' => 'required|integer',
            'duree' => 'required|integer',
            'periodicite' => 'required|string|max:255',
            'type_abonnement' => 'required|string|max:255',
            'moyen_paiement' => 'required|string|max:255'
        ]);

        $subscription = Abonnements::find($id);
        $subscription->id_structure = $request->id_structure;
        $subscription->id_adherent = $request->id_adherent;
        $subscription->duree = $request->duree;
        $subscription->periodicite = $request->periodicite;
        $subscription->type_abonnement = $request->type_abonnement;
        $subscription->moyen_paiement = $request->moyen_paiement;
        $result = $subscription->save();

        // TODO change when view is complete
        if ($result) {
            return response()->json(["Result" => "La souscription a bien été modifiée"], 200);
        } else {
            return response()->json(["Result" => "Operation failed"], 404);
        }
    }

    /**
     * Delete a subscription
     *
     * @OA\Delete(
     *     path="/api/abonnement/{id}",
     *     summary="Delete a subscription",
     *     tags={"Abonnements"},
     *     description="Delete a subscription by ID",
     *     operationId="deleteSubscription",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the subscription to delete",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *

*     @OA\Response(
*         response=200,
*         description="Successful operation",
*
*     ),
*     @OA\Response(response=404, description="Operation failed")
* )
*
* @param $id
* @return \Illuminate\Http\JsonResponse
*/
    public function delete($id)
    {
        $subscription = Abonnements::find($id);
        $id_adherent = $subscription->id_adherent;
        $type_subscription = $subscription->type_abonnement;
        $result = $subscription->delete();

        // TODO change when view is complete
        if ($result) {
            return response()->json(["Result" => "La souscription de l'utilisateur $id_adherent a bien été supprimée"], 200);
        } else {
            return response()->json(["Result" => "Operation failed"], 404);
        }
    }

    /**
     * Get all subscriptions
     *
     * @OA\Get(
     *     path="/api/abonnement",
     *     summary="Get all subscriptions",
     *     tags={"Abonnements"},
     *     description="Get a list of all subscriptions",
     *     operationId="getAllSubscriptions",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *     )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Abonnements::all(), 200);
    }

    /**
     * Get a subscription by ID
     *
     * @OA\Get(
     *     path="/api/abonnement/{id}",
     *     summary="Get a subscription by ID",
     *     tags={"Abonnements"},
     *     description="Get details of a subscription by ID",
     *     operationId="getSubscriptionById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the subscription to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *          ),
     *     @OA\Response(response=404, description="Subscription not found")
     * )
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $subscription = Abonnements::find($id);
        if ($subscription) {
            return response()->json($subscription, 200);
        } else {
            return response()->json(['message' => 'Subscription not found'], 404);
        }
    }
}

