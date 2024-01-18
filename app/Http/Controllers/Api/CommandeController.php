<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Commandes;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Commandes",
 *     description="API Endpoints of Order Controller"
 * )
 * Class CommandeController
 * @package App\Http\Controllers\Api
 */
class CommandeController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/commande",
     *     summary="Add a new order",
     *     tags={"Commandes"},
     *     description="Add a new order for a structure",
     *     operationId="addNewOrder",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"structure_id", "adherents_id", "tournee_id", "abonnements_id", "produits_id", "date_commande", "date_preparation"},
     *             @OA\Property(property="structure_id", type="numeric"),
     *             @OA\Property(property="adherents_id", type="numeric"),
     *             @OA\Property(property="tournee_id", type="numeric"),
     *             @OA\Property(property="abonnements_id", type="numeric"),
     *             @OA\Property(property="produits_id", type="numeric"),
     *             @OA\Property(property="date_commande", type="string", format="date"),
     *             @OA\Property(property="date_preparation", type="string", format="date"),
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
            'structure_id' => 'required|numeric',
            'adherents_id' => 'required|numeric',
            'tournee_id' => 'required|numeric',
            'abonnements_id' => 'required|numeric',
            'produits_id' => 'required|numeric',
            'date_commande' => 'required|date',
            'date_preparation' => 'required|date',
        ]);

        $order = new Commandes();
        $order->structure_id = $request->structure_id;
        $order->adherents_id = $request->adherents_id;
        $order->tournee_id = $request->tournee_id;
        $order->abonnements_id = $request->abonnements_id;
        $order->produits_id = $request->produits_id;
        $order->date_commande = $request->date_commande;
        $order->date_preparation = $request->date_preparation;

        $result = $order->save();

        if ($result) {
            return response()->json($order, 201);
        } else {
            return response()->json(['message' => 'Operation failed'], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/commande/{id}",
     *     summary="Update an order",
     *     tags={"Commandes"},
     *     description="Update details of an order by ID",
     *     operationId="updateOrder",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the order to update",
     *         required=true,
     *         @OA\Schema(type="numeric")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"structure_id", "adherents_id", "tournee_id", "abonnements_id", "produits_id", "date_commande", "date_preparation"},
     *             @OA\Property(property="structure_id", type="numeric"),
     *             @OA\Property(property="adherents_id", type="numeric"),
     *             @OA\Property(property="tournee_id", type="numeric"),
     *             @OA\Property(property="abonnements_id", type="numeric"),
     *             @OA\Property(property="produits_id", type="numeric"),
     *             @OA\Property(property="date_commande", type="string", format="date"),
     *             @OA\Property(property="date_preparation", type="string", format="date"),
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
            'structure_id' => 'required|numeric',
            'adherents_id' => 'required|numeric',
            'tournee_id' => 'required|numeric',
            'abonnements_id' => 'required|numeric',
            'produits_id' => 'required|numeric',
            'date_commande' => 'required|date',
            'date_preparation' => 'required|date',
        ]);

        $order = Commandes::find($id);
        $order->structure_id = $request->structure_id;
        $order->adherents_id = $request->adherents_id;
        $order->tournee_id = $request->tournee_id;
        $order->abonnements_id = $request->abonnements_id;
        $order->produits_id = $request->produits_id;
        $order->date_commande = $request->date_commande;
        $order->date_preparation = $request->date_preparation;

        $result = $order->save();

        if ($result) {
            return response()->json($order, 200);
        } else {
            return response()->json(['message' => 'Operation failed'], 404);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/commande/{id}",
     *     summary="Delete an order",
     *     tags={"Commandes"},
     *     description="Delete an order by ID",
     *     operationId="deleteOrder",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the order to delete",
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
        $order = Commandes::find($id);

        if ($order) {
            $result = $order->delete();

            if ($result) {
                return response()->json(['message' => 'Operation successful'], 200);
            }
        }

        return response()->json(['message' => 'Order not found'], 404);
    }

    /**
     * @OA\Get(
     *     path="/api/commande",
     *     summary="Get all orders",
     *     tags={"Commandes"},
     *     description="Get all orders",
     *     operationId="getAllOrders",
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
        $orders = Commandes::all();

        if ($orders) {
            return response()->json($orders, 200);
        } else {
            return response()->json(['message' => 'Operation failed'], 404);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/commande/{id}",
     *     summary="Get an order",
     *     tags={"Commandes"},
     *     description="Get an order by ID",
     *     operationId="getOrderById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the order to return",
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
        $order = Commandes::find($id);

        if ($order) {
            return response()->json($order, 200);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }
}
