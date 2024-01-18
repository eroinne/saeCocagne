<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Livraisons;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Livraison",
 *     description="API Endpoints for Delivery Controller"
 * )
 * Class DeliveryController
 * @package App\Http\Controllers\Api
 */
class DeliveryController extends Controller
{
    /**
     * Add a new delivery
     *
     * @OA\Post(
     *     path="/api/livraison",
     *     summary="Add a new delivery",
     *     tags={"Livraison"},
     *     description="Add a new delivery",
     *     operationId="addNewDelivery",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"jour", "mois", "date", "numero_semaine", "calendrier_id"},
     *             @OA\Property(property="jour", type="string"),
     *             @OA\Property(property="mois", type="string"),
     *             @OA\Property(property="date", type="string"),
     *             @OA\Property(property="numero_semaine", type="integer"),
     *             @OA\Property(property="calendrier_id", type="integer"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
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
            'jour' => 'required|string',
            'mois' => 'required|string',
            'date' => 'required|string',
            'numero_semaine' => 'required|integer',
            'calendrier_id' => 'required|integer',
        ]);

        $delivery = new Livraisons();
        $delivery->jour = $request->jour;
        $delivery->mois = $request->mois;
        $delivery->date = $request->date;
        $delivery->numero_semaine = $request->numero_semaine;
        $delivery->calendrier_id = $request->calendrier_id;
        $result = $delivery->save();

        if ($result) {
            return response()->json(["Result" => "La livraison a bien été ajoutée"], 200);
        } else {
            return response()->json(["Result" => "Operation failed"], 404);
        }
    }

    // Other methods for update, delete, index, show deliveries...

    // Example for index method:
    /**
     * Get all deliveries
     *
     * @OA\Get(
     *     path="/api/livraison",
     *     summary="Get all deliveries",
     *     tags={"Livraison"},
     *     description="Get a list of all deliveries",
     *     operationId="getAllDeliveries",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Livraisons::all(), 200);
    }

    // Example for show method:
    /**
     * Get a delivery
     *
     * @OA\Get(
     *     path="/api/livraison/{id}",
     *     summary="Get a delivery",
     *     tags={"Livraison"},
     *     description="Get a delivery by ID",
     *     operationId="getDeliveryById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the delivery to show",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Delivery not found",
     *     )
     * )
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
public function show($id)
    {
        $delivery = Livraisons::find($id);
        if ($delivery) {
            return response()->json($delivery, 200);
        } else {
            return response()->json(['message' => 'Delivery not found'], 404);
        }
    }

    // Example for update method:
    /**
     * Update a delivery
     *
     * @OA\Put(
     *     path="/api/livraison/{id}",
     *     summary="Update a delivery",
     *     tags={"Livraison"},
     *     description="Update a delivery by ID",
     *     operationId="updateDeliveryById",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the delivery to update",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"jour", "mois", "date", "numero_semaine", "calendrier_id"},
     *             @OA\Property(property="jour", type="string"),
     *             @OA\Property(property="mois", type="string"),
     *             @OA\Property(property="date", type="string"),
     *             @OA\Property(property="numero_semaine", type="integer"),
     *             @OA\Property(property="calendrier_id", type="integer"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(response=404, description="Delivery not found")
     * )
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
public function update(Request $request, $id)
    {
        $request->validate([
            'jour' => 'required|string',
            'mois' => 'required|string',
            'date' => 'required|string',
            'numero_semaine' => 'required|integer',
            'calendrier_id' => 'required|integer',
        ]);

        $delivery = Livraisons::find($id);
        $delivery->jour = $request->jour;
        $delivery->mois = $request->mois;
        $delivery->date = $request->date;
        $delivery->numero_semaine = $request->numero_semaine;
        $delivery->calendrier_id = $request->calendrier_id;
        $result = $delivery->save();

        if ($result) {
            return response()->json(["Result" => "La livraison a bien été modifiée"], 200);
        } else {
            return response()->json(["Result" => "Operation failed"], 404);
        }
    }

    // Example for delete method:
    /**
     * Delete a delivery
     *
     * @OA\Delete(
     *     path="/api/livraison/{id}",
     *     summary="Delete a delivery",
     *     tags={"Livraison"},
     *     description="Delete a delivery by ID",
     *     operationId="deleteDeliveryById",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the delivery to delete",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="404", description="Delivery not found"),
     * )
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $delivery = Livraisons::find($id);

        if (!$delivery) {
            return response()->json(['message' => 'Delivery not found'], 404);
        }

        $result = $delivery->delete();

        if ($result) {
            return response()->json(["Result" => "La livraison a bien été supprimée"], 200);
        } else {
            return response()->json(["Result" => "Operation failed"], 404);
        }
    }
}

