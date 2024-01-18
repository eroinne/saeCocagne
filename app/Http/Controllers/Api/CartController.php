<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paniers;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Panier",
 *     description="API Endpoints of Cart Controller"
 * )
 * Class CartController
 * @package App\Http\Controllers\Api
 */
class CartController extends Controller
{
    /**
     * Add an item to the shopping cart
     *
     * @OA\Post(
     *     path="/api/panier",
     *     summary="Add an item to the shopping cart",
     *     tags={"Panier"},
     *     description="Add an item to the shopping cart",
     *     operationId="addItemToCart",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Item details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id_structure", type="integer", description="ID of the structure", example=1),
     *             @OA\Property(property="name", type="string", maxLength=255, description="Name of the item", example="Item A"),
     *             @OA\Property(property="type", type="string", maxLength=255, description="Type of the item", example="Type A"),
     *             @OA\Property(property="abonnements", type="string", description="Abonnements information", example="Abonnement A, Abonnement B"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="405", description="Invalid input"),
     * )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Implementation
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'id_structure' => 'required|numeric',
        ]);

        $panier = new Paniers();
        $panier->id_structure = $request->id_structure;
        $panier->nom = $request->name;
        $panier->type = $request->type;
        $panier->abonnements = $request->abonnements;
        $result = $panier->save();

        if ($result) {
            return response()->json(['message' => 'Shopping cart item added successfully'], 200);
        } else {
            return response()->json(['message' => 'Operation failed'], 405);
        }
    }

    /**
     * Update a shopping cart item
     *
     * @OA\Put(
     *     path="/api/panier/{id}",
     *     summary="Update a shopping cart item",
     *     tags={"Panier"},
     *     description="Update a shopping cart item by ID",
     *     operationId="updateCartItem",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the shopping cart item to update",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Item details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id_structure", type="integer", description="ID of the structure", example=1),
     *             @OA\Property(property="name", type="string", maxLength=255, description="Name of the item", example="Item A"),
     *             @OA\Property(property="type", type="string", maxLength=255, description="Type of the item", example="Type A"),
     *             @OA\Property(property="abonnements", type="string", description="Abonnements information", example="Abonnement A, Abonnement B"),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="404", description="Shopping cart item not found"),
     *     @OA\Response(response="405", description="Invalid input"),
     * )
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        // Implementation
        $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'id_structure' => 'required|numeric',
            'abonnements' => 'required|string|max:255',
        ]);

        $panier = Paniers::find($id);
        $panier->id_structure = $request->id_structure;
        $panier->nom = $request->name;
        $panier->type = $request->type;
        $panier->abonnements = $request->abonnements;
        $result = $panier->save();

        if ($result) {
            return response()->json(['message' => 'Shopping cart item updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Shopping cart item not found'], 404);
        }
    }

    /**
     * Delete a shopping cart item
     *
     * @OA\Delete(
     *     path="/api/panier/{id}",
     *     summary="Delete a shopping cart item",
     *     tags={"Panier"},
     *     description="Delete a shopping cart item by ID",
     *     operationId="deleteCartItem",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the shopping cart item to delete",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(response="200", description="Shopping cart item deleted successfully"),
     *     @OA\Response(response="404", description="Shopping cart item not found"),
     * )
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $panier = Paniers::find($id);
        $nom_panier = $panier->nom;
        $result = $panier->delete();

        if ($result) {
            return response()->json(['message' => 'Shopping cart item deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Shopping cart item not found'], 404);
        }
    }

    /**
     * Get all shopping carts
     *
     * @OA\Get(
     *     path="/api/panier",
     *     summary="Get all shopping carts",
     *     tags={"Panier"},
     *     description="Get a list of all shopping carts",
     *     operationId="getAllCarts",
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
        return response()->json(Paniers::all(), 200);
    }

    /**
     * Show a shopping cart
     *
     * @OA\Get(
     *     path="/api/panier/{id}",
     *     summary="Show a shopping cart",
     *     tags={"Panier"},
     *     description="Show details of a shopping cart by ID",
     *     operationId="showCartById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the shopping cart to show",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(response=404, description="Shopping cart not found"),
     * )
     *
     * @param $id
     *
     */
    public function show($id)
    {
        $panier = Paniers::find($id);
        if ($panier) {
            return response()->json($panier, 200) ;
        } else {
            return response()->json(['message' => 'Shopping cart not found'], 404);
        }
    }



}
