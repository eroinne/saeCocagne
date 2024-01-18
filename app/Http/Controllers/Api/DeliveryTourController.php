<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\TournerLivraison;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Tourne-Livraison",
 *     description="API Endpoints of Delivery Tour Controller"
 * )
 * Class DeliveryTourController
 * @package App\Http\Controllers\Api
 */
class DeliveryTourController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/tourneLivraison",
     *     summary="Add a new delivery tour",
     *     tags={"Tourne-Livraison"},
     *     description="Add a new delivery tour for a structure",
     *     operationId="addNewDeliveryTour",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"structures_id", "jour_preparation", "jour_livraison", "couleur", "point_depots"},
     *             @OA\Property(property="structures_id", type="numeric"),
     *             @OA\Property(property="jour_preparation", type="string),
     *             @OA\Property(property="jour_livraison", type="string"),
     *             @OA\Property(property="couleur", type="string"),
     *             @OA\Property(property="point_depots", type="string"),
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
            'structures_id' => 'required|numeric',
            'jour_preparation' => 'required|string',
            'jour_livraison' => 'required|string',
            'couleur' => 'required|string',
            'point_depots' => 'required|string',
        ]);

        $deliveryTour = new TournerLivraison();
        $deliveryTour->structures_id = $request->structures_id;
        $deliveryTour->jour_preparation = $request->jour_preparation;
        $deliveryTour->jour_livraison = $request->jour_livraison;
        $deliveryTour->couleur = $request->couleur;
        $deliveryTour->point_depots = $request->point_depots;

        $result = $deliveryTour->save();

        if ($result) {
            return response()->json(['Result' => 'La tournée de livraison pour la structure ' . $deliveryTour->structures_id . ' a bien été ajoutée'], 200);
        } else {
            return response()->json(['message' => 'Operation failed'], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/tourneLivraison/{id}",
     *     summary="Update a delivery tour",
     *     tags={"Tourne-Livraison"},
     *     description="Update details of a delivery tour by ID",
     *     operationId="updateDeliveryTour",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the delivery tour to update",
     *         required=true,
     *         @OA\Schema(type="numeric")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"structures_id", "jour_preparation", "jour_livraison", "couleur", "point_depots"},
     *             @OA\Property(property="structures_id", type="numeric"),
     *             @OA\Property(property="jour_preparation", type="string"),
     *             @OA\Property(property="jour_livraison", type="string"),
     *             @OA\Property(property="couleur", type="string"),
     *             @OA\Property(property="point_depots", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
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
            'structures_id' => 'required|numeric',
            'jour_preparation' => 'required|string',
            'jour_livraison' => 'required|string',
            'couleur' => 'required|string',
            'point_depots' => 'required|string',
        ]);

        $deliveryTour = TournerLivraison::find($id);
        $deliveryTour->structures_id = $request->structures_id;
        $deliveryTour->jour_preparation = $request->jour_preparation;
        $deliveryTour->jour_livraison = $request->jour_livraison;
        $deliveryTour->couleur = $request->couleur;
        $deliveryTour->point_depots = $request->point_depots;

        $result = $deliveryTour->save();

        if ($result) {
            return response()->json($deliveryTour, 200);
        } else {
            return response()->json(['message' => 'Operation failed'], 404);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/tourneLivraison/{id}",
     *     summary="Delete a delivery tour",
     *     tags={"Tourne-Livraison"},
     *     description="Delete a delivery tour by ID",
     *     operationId="deleteDeliveryTour",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the delivery tour to delete",
     *         required=true,
     *         @OA\Schema(type="numeric")
     *     ),
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
        $deliveryTour = TournerLivraison::find($id);

        if ($deliveryTour) {
            $result = $deliveryTour->delete();

            if ($result) {
                return response()->json(['message' => 'La tournée de livraison pour la structure ' . $deliveryTour->structures_id . ' a bien été supprimée'], 200);
            }
        }

        return response()->json(['message' => 'Operation failed'], 404);
    }

    /**
     * @OA\Get(
     *     path="/api/tourneLivraison",
     *     summary="Get all delivery tours",
     *     tags={"Tourne-Livraison"},
     *     description="Get all delivery tours",
     *     operationId="getAllDeliveryTours",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *     ),
     *     @OA\Response(response=404, description="Operation failed")
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $deliveryTours = TournerLivraison::all();

        if ($deliveryTours) {
            return response()->json($deliveryTours, 200);
        } else {
            return response()->json(['message' => 'Operation failed'], 404);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/tourneLivraison/{id}",
     *     summary="Get a delivery tour",
     *     tags={"Tourne-Livraison"},
     *     description="Get a delivery tour by ID",
     *     operationId="getDeliveryTourById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the delivery tour to return",
     *         required=true,
     *         @OA\Schema(type="numeric")
     *     ),
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
    public function show($id)
    {
        $deliveryTour = TournerLivraison::find($id);

        if ($deliveryTour) {
            return response()->json($deliveryTour, 200);
        } else {
            return response()->json(['message' => 'Operation failed'], 404);
        }
    }

}
