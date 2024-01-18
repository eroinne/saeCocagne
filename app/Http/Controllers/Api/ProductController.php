<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produits;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Produits",
 *     description="API Endpoints of Product Controller"
 * )
 * Class ProductController
 * @package App\Http\Controllers\Api
 */
class ProductController extends Controller
{
    /**
     * Add a product
     *
     * @OA\Post(
     *     path="/api/produit",
     *     summary="Add a product",
     *     tags={"Produits"},
     *     description="Add a product",
     *     operationId="addProduct",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Product details",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="type", type="string", maxLength=255),
     *             @OA\Property(property="price", type="number"),
     *             @OA\Property(property="unit", type="string", maxLength=255, nullable=true),
     *             @OA\Property(property="unit_value", type="string", maxLength=255, nullable=true),
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
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'unit' => 'required|string|max:255|nullable',
            'unit_value' => 'required|string|max:255|nullable',
        ]);

        $product = new Produits();
        $product->nom = $request->name;
        $product->type = $request->type;
        $product->prix = $request->price;
        $product->unite = $request->unit;
        $product->valeur_unite = $request->unit_value;
        $result = $product->save();

        if($result){
            return response()->json(['message' => 'Product added successfully'], 200);

        }else{
            return response()->json(['message' => 'Error adding product'], 500);
        }
    }

    //delete a product
    /**
     * Delete a product
     *
     * @OA\Delete(
     *     path="/api/produit/{id}",
     *     summary="Delete a product",
     *     tags={"Produits"},
     *     description="Delete a product by ID",
     *     operationId="deleteProduct",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to delete",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(response="200", description="Product deleted successfully"),
     *     @OA\Response(response="404", description="Product not found"),
     * )
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){
        $product = Produits::find($id);
        $nom_product = $product->nom;
        $result = $product->delete();
        if(!$result){
            return response()->json(['message' => 'Product deleted successfully'], 200);
        }else{
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
    //update a product
    /**
     * Update a product
     *
     * @OA\Put(
     *     path="/api/produit/{id}",
     *     summary="Update a product",
     *     tags={"Produits"},
     *     description="Update a product by ID",
     *     operationId="updateProduct",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to update",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Product details",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="type", type="string", maxLength=255),
     *             @OA\Property(property="price", type="number"),
     *             @OA\Property(property="unit", type="string", maxLength=255, nullable=true),
     *             @OA\Property(property="unit_value", type="string", maxLength=255, nullable=true),
     *         )
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="404", description="Product not found"),
     *     @OA\Response(response="405", description="Invalid input"),
     * )
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'unit' => 'required|string|max:255|nullable',
            'unit_value' => 'required|string|max:255|nullable',
        ]);
        $product = Produits::find($id);
        $product->nom = $request->name;
        $product->type = $request->type;
        $product->prix = $request->price;
        $product->unite = $request->unit;
        $product->valeur_unite = $request->unit_value;
        $result = $product->save();
        //TODO change wen view is complete
        if($result){
            return response()->json(['message' => 'Product updated successfully'], 200);
        }else{
            return response()->json(['message' => 'Product not found'], 404);
        }
    }
    /**
     * Show all products
     *
     * @OA\Get(
     *     path="/api/produit",
     *     summary="Show all products",
     *     tags={"Produits"},
     *     description="Get a list of all products",
     *     operationId="indexProducts",
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation"
     *     ),
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        return response()->json(Produits::all(), 200);
    }

    /**
     * Show a product
     *
     * @OA\Get(
     *     path="/api/produit/{id}",
     *     summary="Show a product",
     *     tags={"Produits"},
     *     description="Get a product by ID",
     *     operationId="showProduct",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to show",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Product not found"
     *     ),
     * )
     *
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        $product = Produits::find($id);
        return response()->json($product, 200);
    }
}
