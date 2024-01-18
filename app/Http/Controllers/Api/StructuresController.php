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
    /**
     * @OA\SecurityScheme(
     *      type="apiKey",
     *      in="header",
     *      name="Authorization",
     *      securityScheme="bearerAuth",
     *  )
     * @OA\Post(
     * *     path="/api/structures/",
     * *     summary="Add a structure",
     * *     tags={"Structures"},
     * *     description="Add a structure",
     * *     operationId="store",
     * *     security={{"bearerAuth":{}}},
     * *     @OA\RequestBody(
     * *         required=true,
     * *         description="Structure details",
     * *         @OA\JsonContent(
     *             required={"name", "city", "mail", "phone", "web_site", "social_reason", "social_headquarters", "referent_name", "manager_address"},
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="city", type="string", maxLength=255),
     *             @OA\Property(property="mail", type="string", maxLength=255),
     *             @OA\Property(property="phone", type="string", maxLength=255),
     *             @OA\Property(property="web_site", type="string", maxLength=255),
     *             @OA\Property(property="social_reason", type="string", maxLength=255),
     *             @OA\Property(property="social_headquarters", type="string", maxLength=255),
     *             @OA\Property(property="referent_name", type="string", maxLength=255, nullable=true),
     *             @OA\Property(property="manager_address", type="string", maxLength=255),
     *             @OA\Property(property="zone", type="string", maxLength=255),
     *         )
     *     ),
     *     @OA\Response(response="200", description="successful operation", @OA\JsonContent(
     *         type="object",
     *     @OA\Property(property="message", type="string", example="Structure ajoutée avec succès")
     *    )),
     *     ),
     *     @OA\Response(response="422", description="Invalid input", @OA\JsonContent(
     *         type="object",
     *     @OA\Property(property="message", type="string", example="Erreur de validation des données")
     *     ),
     * )
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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
            'zone' => 'required|string|max:255',
        ]);

        $structure = new Structures();
        $structure->nom = $request->name;
        $structure->ville = $request->city;
        $structure->mail = $request->mail;
        $structure->telephone = $request->phone;
        $structure->site_web = $request->web_site;
        $structure->raison_sociale = $request->social_reason;
        $structure->siege_social = $request->social_headquarters;
        $structure->nom_referent = $request->referent_name;
        $structure->adresse_gestion = $request->manager_address;
        $structure->zone = $request->zone;
        $result = $structure->save();

        if($result){
            return response()->json(['message' => 'Structure added successfully'], 200);
        }else{
            return response()->json(['message' => 'Error adding structure'], 500);
        }
    }

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
     *         description="ID de la structure à mettre à jour",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de mise à jour de la structure",
     *         @OA\JsonContent(
     *             required={"name", "city", "mail", "phone", "web_site", "social_reason", "social_headquarters", "referent_name", "manager_address"},
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="city", type="string", maxLength=255),
     *             @OA\Property(property="mail", type="string", maxLength=255),
     *             @OA\Property(property="phone", type="string", maxLength=255),
     *             @OA\Property(property="web_site", type="string", maxLength=255),
     *             @OA\Property(property="social_reason", type="string", maxLength=255),
     *             @OA\Property(property="social_headquarters", type="string", maxLength=255),
     *             @OA\Property(property="referent_name", type="string", maxLength=255, nullable=true),
     *             @OA\Property(property="manager_address", type="string", maxLength=255),
     *             @OA\Property(property="zone", type="string", maxLength=255),
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
     * )
     */
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'social_reason' => 'required|string|max:255',
            'social_headquarters' => 'required|string|max:255',
            'manager_address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'mail' => 'required|string|max:255',
            'referent_name' => 'nullable|string|max:255',
            'web_site' => 'required|string|max:255',
            'zone' => 'required|string|max:255',
        ]);

        $structure = Structures::find($id);

        if ($structure) {
            // La structure a été trouvée, vous pouvez mettre à jour ses propriétés
            $structure->nom = $request->name;
            $structure->ville = $request->city;
            $structure->mail = $request->mail;
            $structure->telephone = $request->phone;
            $structure->site_web = $request->web_site;
            $structure->raison_sociale = $request->social_reason;
            $structure->siege_social = $request->social_headquarters;
            $structure->nom_referent = $request->referent_name;
            $structure->adresse_gestion = $request->manager_address;
            $structure->zone = $request->zone;

            $result = $structure->save();

            if ($result) {
                return response()->json(['message' => 'Structure updated successfully'], 200);
            } else {
                return response()->json(['message' => 'Error updating structure'], 500);
            }
        } else {
            // La structure n'a pas été trouvée, renvoyez une réponse appropriée
            return response()->json(['message' => 'Structure not found'], 404);
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
            return response()->json(['message' => 'Structure non trouvée'], 404);
        }

        $structure->delete();

        return response()->json(['message' => 'Structure supprimée'], 200);
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
