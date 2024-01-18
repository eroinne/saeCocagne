<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Structures;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Structures",
 *     description="API Endpoints of Structures Controller"
 * )
 *
 * Class StructuresController
 * @package App\Http\Controllers\Api
 */
class StructuresController extends Controller
{
    //add a strucutre
    /**
     * @OA\Post(
     *     path="/api/structures",
     *     summary="Add a structure",
     *     tags={"Structures"},
     *     description="Add a structure",
     *     operationId="store",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         description="name of structure",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="city",
     *         in="path",
     *         description="city of structure",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="social_reason",
     *         in="path",
     *         description="social reason of structure",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="social_headquarters",
     *         in="path",
     *         description="social headquarters of structure",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="manager_address",
     *         in="path",
     *         description="manager address of structure",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="phone",
     *         in="path",
     *         description="phone of structure",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="mail",
     *         in="path",
     *         description="mail of structure",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="referent_name",
     *         in="path",
     *         description="referent name of structure",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Parameter(
     *         name="web_site",
     *         in="path",
     *         description="web site of structure",
     *         required=true,
     *         @OA\Schema(type="string"),
     *     ),
     *     @OA\Response(response="200", description="successful operation"),
     *     @OA\Response(response="422", description="Invalid input"),
     * )
     */

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'social_reason' => 'required|string|max:255',
            'social_headquarters' => 'required|string|max:255',
            'manager_address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'mail' => 'required|string|max:255',
            'referent_name' => 'required|string|max:255|nullable',
            'web_site' => 'required|string|max:255',
        ]);

        $structure = new Structures();
        $structure->nom = $request->name;
        $structure->type = $request->city;
        $structure->mail = $request->mail;
        $structure->telephone = $request->phone;
        $structure->site_web = $request->web_site;
        $structure->raison_sociale = $request->social_reason;
        $structure->siege_social = $request->social_headquarters;
        $structure->nom_referent = $request->referent_name;
        $structure->adresse_gestion = $request->manager_address;
        $result = $structure->save();


        if($result){
            return response()->json(['message' => 'Structure added successfully'], 200);
        }else{
            return response()->json(['message' => 'Error adding structure'], 500);
        }
    }

    //update a structure
    /**
     * @OA\Put(
     *     path="/api/structures/{id}",
     *     summary="Mettre à jour une structure",
     *     description="Met à jour les informations d'une structure en fonction de l'ID fourni",
     *     tags={"Structures"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la structure à mettre à jour",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de mise à jour de la structure",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(property="name", type="string", maxLength=255),
     *                 @OA\Property(property="city", type="string", maxLength=255),
     *                 @OA\Property(property="mail", type="string", maxLength=255),
     *                 @OA\Property(property="phone", type="string", maxLength=255),
     *                 @OA\Property(property="web_site", type="string", maxLength=255),
     *                 @OA\Property(property="social_reason", type="string", maxLength=255),
     *                 @OA\Property(property="social_headquarters", type="string", maxLength=255),
     *                 @OA\Property(property="referent_name", type="string", maxLength=255, nullable=true),
     *                 @OA\Property(property="manager_address", type="string", maxLength=255),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Opération réussie - La structure a été mise à jour avec succès",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="Result", type="string", example="La structure [nom] a bien été modifiée")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Structure non trouvée - Aucune structure trouvée avec l'ID fourni",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erreur de validation des données - Vérifiez les contraintes de validation dans la documentation",
     *     ),
     *     security={
     *         {"api_key": {}}
     *     }
     *     )
     * )
     */
    public function update(Request $request, $id){
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'social_reason' => 'required|string|max:255',
            'social_headquarters' => 'required|string|max:255',
            'manager_address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'mail' => 'required|string|max:255',
            'referent_name' => 'required|string|max:255|nullable',
            'web_site' => 'required|string|max:255',
        ]);

        $structure = Structures::find($id);
        $structure->nom = $request->name;
        $structure->type = $request->city;
        $structure->mail = $request->mail;
        $structure->telephone = $request->phone;
        $structure->site_web = $request->web_site;
        $structure->raison_sociale = $request->social_reason;
        $structure->siege_social = $request->social_headquarters;
        $structure->nom_referent = $request->referent_name;
        $structure->adresse_gestion = $request->manager_address;
        $result = $structure->save();

        //TODO change wen view is complete
        if($result){
            return response()->json(['message' => 'Structure updated successfully'], 200);
        }else{
            return response()->json(['message' => 'Error updating structure'], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/structures/{id}",
     *     summary="Delete a structure",
     *     tags={"Structures"},
     *     description="Delete a structure",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of structure to delete",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(response="200", description="successful operation"),
     *      @OA\Response(response="404", description="Structure not found"),
     * )
     */
    public function delete($id)
    {
        $structure = Structures::find($id);

        if (!$structure) {
            return response()->json(['message' => 'Abonnement non trouvée'], 404);
        }

        $structure->delete();

        return response()->json(['message' => 'Abonnement supprimée'], 200);
    }




    //get all structures for api
    /**
     * @OA\Get(
     *     path="/api/structures",
     *     summary="Get all structures",
     *     tags={"Structures"},
     *     description="Get all structures",
     *     operationId="index",
     *
     *     @OA\Response(response="200", description="successful operation"),
     * *    @OA\Response(response="405", description="Invalid input"),
     * )
     */

    public function index()
    {
        return response()->json(Structures::all(), 200);
    }

    //get a structure
    /**
     * @OA\Get(
     *     path="/api/structures/{id}",
     *     summary="Get a structure",
     *     tags={"Structures"},
     *     description="Get a structure",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="id of structure to return",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(response="200", description="successful operation"),
     *      @OA\Response(response="404", description="Structure not found"),
     * )
     */
    public function show($id)
    {
        return response()->json(Structures::find($id), 200);
    }


}
