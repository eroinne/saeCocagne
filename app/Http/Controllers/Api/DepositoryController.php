<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Depots;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Depots",
 *     description="API Endpoints of Depositories Controller"
 * )
 * Class DepositoryController
 * @package App\Http\Controllers\Api
 */
class DepositoryController extends Controller
{
    //add a depository
    /**
     * @OA\Post(
     *     path="/api/depot",
     *     summary="Add a new depository",
     *     tags={"Depots"},
     *     description="Add a new depository for a structure",
     *     operationId="addNewDepository",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_structure", "name", "city", "address", "zip_code", "phone", "mail", "web_site", "delivery_day", "delivery_hour", "basket_hour", "presentation_text", "image_path", "comment"},
     *             @OA\Property(property="id_structure", type="numeric"),
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="city", type="string", maxLength=255),
     *             @OA\Property(property="address", type="string", maxLength=255),
     *             @OA\Property(property="zip_code", type="string", maxLength=255),
     *             @OA\Property(property="phone", type="string", maxLength=255),
     *             @OA\Property(property="mail", type="string", maxLength=255),
     *             @OA\Property(property="web_site", type="string", maxLength=255),
     *             @OA\Property(property="delivery_day", type="date"),
     *             @OA\Property(property="delivery_hour", type="date_format:H:i"),
     *             @OA\Property(property="basket_hour", type="date_format:H:i"),
     *             @OA\Property(property="presentation_text", type="string", maxLength=255),
     *             @OA\Property(property="image_path", type="string", maxLength=255),
     *             @OA\Property(property="comment", type="string", maxLength=255),
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
        {
            $request->validate([
                'id_structure' => 'required|numeric',
                'name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'zip_code' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'mail' => 'required|string|max:255|nullable',
                'web_site' => 'required|string|max:255|nullable',
                'delivery_day' => 'required|date',
                'delivery_hour' => 'required|date_format:H:i',
                'basket_hour' => 'required|date_format:H:i',
                'presentation_text' => 'required|string|max:255|nullable',
                'image_path' => 'required|string|max:255|nullable',
                'comment' => 'required|string|max:255|nullable',
            ]);

            $depository = new Depots();
            $depository->id_structure = $request->id_structure;
            $depository->nom = $request->name;
            $depository->ville = $request->city;
            $depository->adresse = $request->address;
            $depository->code_postal = $request->zip_code;
            $depository->telephone = $request->phone;
            $depository->mail = $request->mail;
            $depository->siteWeb = $request->web_site;
            $depository->jour_livraison = $request->delivery_day;
            $depository->heure_livraison = $request->delivery_hour;
            $depository->heure_paniers = $request->basket_hour;
            $depository->text_presentation = $request->presentation_text;
            $depository->chemin_image = $request->image_path;
            $depository->commentaire = $request->comment;
            $result = $depository->save();


            if ($result) {
                return response()->json(["Result" => "Le dépot $depository->nom a bien été ajouté"], 200);
            } else {
                return response()->json(["Result" => "Operation failed"], 404);
            }
        }
    }

    //update a depository

    /**
     * @OA\Put(
     *     path="/api/depot/{id}",
     *     summary="Update a depository",
     *     tags={"Depots"},
     *     description="Update details of a depository by ID",
     *     operationId="updateDepository",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the depository to update",
     *         required=true,
     *         @OA\Schema(type="numeric")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_structure", "name", "city", "address", "zip_code", "phone", "mail", "web_site", "delivery_day", "delivery_hour", "basket_hour", "presentation_text", "image_path", "comment"},
     *             @OA\Property(property="id_structure", type="numeric"),
     *             @OA\Property(property="name", type="string", maxLength=255),
     *             @OA\Property(property="city", type="string", maxLength=255),
     *             @OA\Property(property="address", type="string", maxLength=255),
     *             @OA\Property(property="zip_code", type="string", maxLength=255),
     *             @OA\Property(property="phone", type="string", maxLength=255),
     *             @OA\Property(property="mail", type="string", maxLength=255),
     *             @OA\Property(property="web_site", type="string", maxLength=255),
     *             @OA\Property(property="delivery_day", type="date"),
     *             @OA\Property(property="delivery_hour", type="date_format:H:i"),
     *             @OA\Property(property="basket_hour", type="date_format:H:i"),
     *             @OA\Property(property="presentation_text", type="string", maxLength=255),
     *             @OA\Property(property="image_path", type="string", maxLength=255),
     *             @OA\Property(property="comment", type="string", maxLength=255),
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
            'id_structure' => 'required|numeric',
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'zip_code' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'mail' => 'required|string|max:255|nullable',
            'web_site' => 'required|string|max:255|nullable',
            'delivery_day' => 'required|date',
            'delivery_hour' => 'required|date_format:H:i',
            'basket_hour' => 'required|date_format:H:i',
            'presentation_text' => 'required|string|max:255|nullable',
            'image_path' => 'required|string|max:255|nullable',
            'comment' => 'required|string|max:255|nullable',
        ]);

        $depository = Depots::find($id);
        $depository->id_structure = $request->id_structure;
        $depository->nom = $request->name;
        $depository->ville = $request->city;
        $depository->adresse = $request->address;
        $depository->code_postal = $request->zip_code;
        $depository->telephone = $request->phone;
        $depository->mail = $request->mail;
        $depository->siteWeb = $request->web_site;
        $depository->jour_livraison = $request->delivery_day;
        $depository->heure_livraison = $request->delivery_hour;
        $depository->heure_paniers = $request->basket_hour;
        $depository->text_presentation = $request->presentation_text;
        $depository->chemin_image = $request->image_path;
        $depository->commentaire = $request->comment;
        $result = $depository->save();

        if ($result) {
            return response()->json(["Result" => "Le dépot $depository->nom a bien été modifié"], 200);
        } else {
            return response()->json(["Result" => "Operation failed"], 404);
        }
    }

    //delete a depository

    /**
     * @OA\Delete(
     *     path="/api/depot/{id}",
     *     summary="Delete a depository",
     *     tags={"Depots"},
     *     description="Delete a depository by ID",
     *     operationId="deleteDepository",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the depository to delete",
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
        $depository = Depots::find($id);
        $nom_depository = $depository->nom;
        $result = $depository->delete();

        if ($result) {
            return response()->json(["Result" => "Le dépot $nom_depository a bien été supprimé"], 200);
        } else {
            return response()->json(["Result" => "Operation failed"], 404);
        }
    }

    //index all depositories

    /**
     * @OA\Get(
     *     path="/api/depots",
     *     summary="Get all depositories",
     *     tags={"Depots"},
     *     description="Get all depositories",
     *     operationId="getAllDepositories",
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
        $depositories = Depots::all();
        return response()->json($depositories, 200);
    }

    //show a depository

    /**
     * @OA\Get(
     *     path="/api/depot/{id}",
     *     summary="Get a depository",
     *     tags={"Depots"},
     *     description="Get a depository by ID",
     *     operationId="getDepositoryById",
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the depository to return",
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
        if (Depots::where('id', $id)->exists()) {
            $depository = Depots::find($id);
            return response()->json($depository, 200);
        } else {
            return response()->json(["Result" => "Depository not found"], 404);
        }
    }
}
