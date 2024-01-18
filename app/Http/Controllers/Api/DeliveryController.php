<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TournerLivraison;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Livraisons",
 *     description="API Endpoints of Delivery Controller"
 * )
 * Class DeliveryController
 * @package App\Http\Controllers\Api
 */

class DeliveryController extends Controller
{
    /**
     * Add a delivery
     *
     * @OA\Post(
     *     path="/api/livraisons",
     *     summary="Add a delivery",
     *     tags={"Livraisons"},
     *     description="Add a delivery",
     *     operationId="addDelivery",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Delivery details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id_structure", type="integer", description="ID of the structure", example=1),
     *             @OA\Property(property="days_delivery", type="string", format="date", description="Delivery date", example="2024-01-15"),
     *             @OA\Property(property="days_preparation", type="string", format="date", description="Preparation date", example="2024-01-14"),
     *             @OA\Property(property="color", type="string", maxLength=255, description="Color of the delivery", example="Blue"),
     *             @OA\Property(property="repositories", type="string", maxLength=500, description="Repositories information", example="Repository A, Repository B"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="405", description="Invalid input"),
     * )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $request->validate([
            'id_structure' => 'required|numeric',
            'days_delivery' => 'required|date|after:dateline_start',
            'days_preparation' => 'required|date|before:dateline_end',
            'color' => 'required|string|max:255',
            'repositories' => 'required|string|max:500',

        ]);

        $delivery = new TournerLivraison();
        $delivery->id_structure = $request->id_structure;
        $delivery->date_livraison = $request->days_delivery;
        $delivery->date_preparation = $request->days_preparation;
        $delivery->couleur = $request->color;
        $delivery->point_depots = $request->repositories;
        $result = $delivery->save();

        //TODO change wen view is complete
        if($result){
            return response()->json(['message' => 'Delivery added successfully'], 200);
        }else{
            return response()->json(['message' => 'Error adding delivery'], 500);
        }
    }

    /**
     * Update a delivery
     *
     * @OA\Put(
     *     path="/api/livraisons/{id}",
     *     summary="Update a delivery",
     *     tags={"Livraisons"},
     *     description="Update a delivery by ID",
     *     operationId="updateDelivery",
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
     *         description="Delivery details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id_structure", type="integer", description="ID of the structure", example=1),
     *             @OA\Property(property="days_delivery", type="string", format="date", description="Delivery date", example="2024-01-15"),
     *             @OA\Property(property="days_preparation", type="string", format="date", description="Preparation date", example="2024-01-14"),
     *             @OA\Property(property="color", type="string", maxLength=255, description="Color of the delivery", example="Blue"),
     *             @OA\Property(property="repositories", type="string", maxLength=500, description="Repositories information", example="Repository A, Repository B"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="404", description="Delivery not found"),
     *     @OA\Response(response="405", description="Invalid input"),
     * )
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){
        $request->validate([
            'id_structure' => 'required|numeric',
            'days_delivery' => 'required|date|after:dateline_start',
            'days_preparation' => 'required|date|before:dateline_end',
            'color' => 'required|string|max:255',
            'repositories' => 'required|string|max:500',

        ]);

        $delivery = TournerLivraison::find($id);
        $delivery->id_structure = $request->id_structure;
        $delivery->date_livraison = $request->days_delivery;
        $delivery->date_preparation = $request->days_preparation;
        $delivery->couleur = $request->color;
        $delivery->point_depots = $request->repositories;
        $result = $delivery->save();

        //TODO change wen view is complete
        if($result){
            return response()->json(['message' => 'Delivery updated successfully'], 200);
        }else{
            return response()->json(['message' => 'Delivery not found'], 404);
        }
    }

    /**
     * Delete a delivery
     *
     * @OA\Delete(
     *     path="/api/livraisons/{id}",
     *     summary="Delete a delivery",
     *     tags={"Livraisons"},
     *     description="Delete a delivery by ID",
     *     operationId="deleteDelivery",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the delivery to delete",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(response="200", description="Delivery deleted successfully"),
     *     @OA\Response(response="404", description="Delivery not found"),
     * )
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){
        $delivery = TournerLivraison::find($id);
        $id_delivery = $delivery->id;
        $result = $delivery->delete();
        if ($result) {
            return response()->json(['message' => 'Delivery deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Delivery not found'], 404);
        }
    }

    /**
     * Show a delivery
     *
     * @OA\Get(
     *     path="/api/livraisons/{id}",
     *     summary="Show a delivery",
     *     tags={"Livraisons"},
     *     description="Get a delivery by ID",
     *     operationId="showDelivery",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the delivery to show",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation"
     *     ),
     *     @OA\Response(response="404", description="Delivery not found"),
     * )
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $delivery = TournerLivraison::find($id);
        if ($delivery) {
            return response()->json($delivery, 200);
        } else {
            return response()->json(['message' => 'Delivery not found'], 404);
        }
    }

    /**
     * Show all deliveries
     *
     * @OA\Get(
     *     path="/api/livraisons",
     *     summary="Show all deliveries",
     *     tags={"Livraisons"},
     *     description="Get a list of all deliveries",
     *     operationId="indexDeliveries",
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation"
     *     ),
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $delivery = TournerLivraison::all();
       if ($delivery) {
            return response()->json($delivery, 200);
        } else {
            return response()->json(['message' => 'Delivery not found'], 404);
        }
    }




}
