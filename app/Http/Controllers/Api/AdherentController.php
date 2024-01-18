<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Adherents;
use App\Models\Livraisons;
use App\Models\Structures;
use App\Models\Calendriers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
/**
 * @OA\Tag(
 *     name="Adherents",
 *     description="API Endpoints of Adherents"
 * )
 *
 * Class AdherentController
 * @package App\Http\Controllers\Api
 */
class AdherentController extends Controller
{
    /**
     *
     * @OA\Put(
     *     path="/api/adherents/{id}",
     *     tags={"Adherents"},
     *     summary="Update user's profile",
     *     description="Updates the user's profile information",
     *     operationId="updateProfile",
     *      security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the user to update",
     *     required=true,
     *     @OA\Schema(type="integer", format="int64")
     *    ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         description="User's profile data for update",
     *        @OA\JsonContent(
     *     required={"name", "prenom", "raison_sociale", "civilite", "email", "ville", "adresse", "code_postal", "numero_telephone"},
     *     @OA\Property(property="name", type="string", maxLength=255),
     *     @OA\Property(property="prenom", type="string", maxLength=255),
     *     @OA\Property(property="raison_sociale", type="string", maxLength=255),
     *     @OA\Property(property="civilite", type="string", maxLength=255, enum={"mme", "mr"}),
     *     @OA\Property(property="email", type="string", format="email", maxLength=255),
     *     @OA\Property(property="ville", type="string", maxLength=255),
     *     @OA\Property(property="adresse", type="string", maxLength=255),
     *     @OA\Property(property="code_postal", type="numeric"),
     *     @OA\Property(property="numero_telephone", type="numeric", pattern="/^0[1-9]\d{8}$/"),
     *     @OA\Property(property="numero_telephone2", type="numeric", pattern="/^0[1-9]\d{8}$/", nullable=true),
     *     @OA\Property(property="numero_telephone3", type="numeric", pattern="/^0[1-9]\d{8}$/", nullable=true),
     *     @OA\Property(property="profession", type="string", maxLength=255, nullable=true),
     *     @OA\Property(property="date_naissance", type="date", nullable=true),
     *     @OA\Property(property="photo", type="string", format="binary", maxLength=2048, nullable=true),
     *     )
     *     ),
     *     @OA\Response(response="200", description="Profile updated successfully"),
     *     @OA\Response(response="422", description="Validation error"),
     *     @OA\Response(response="500", description="Error updating profile"),
     *
     * )
     *
     */
    public function update(Request $request,$id): \Illuminate\Http\JsonResponse
    {
        $user = Adherents::find($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'raison_sociale' => ['required', 'string', 'max:255'],
            'civilite' => ['required', 'string', 'max:255', Rule::in(['mme', 'mr'])],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(Adherents::class)->ignore($user->id)],
            'ville' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'numeric'],
            'numero_telephone' => ['required', 'numeric', 'regex:/^0[1-9]\d{8}$/'],
            'numero_telephone2' => ['nullable', 'numeric', 'regex:/^0[1-9]\d{8}$/'],
            'numero_telephone3' => ['nullable', 'numeric', 'regex:/^0[1-9]\d{8}$/'],
            'profession' => ['nullable', 'string', 'max:255'],
            'date_naissance' => ['nullable', 'date'],
        ]);

        $user->name = $request->name;
        $user->prenom = $request->prenom;
        $user->raison_sociale = $request->raison_sociale;
        $user->civilite = $request->civilite;
        $user->email = $request->email;
        $user->ville = $request->ville;
        $user->adresse = $request->adresse;
        $user->code_postal = $request->code_postal;
        $user->numero_telephone = $request->numero_telephone;
        $user->numero_telephone2 = $request->numero_telephone2;
        $user->numero_telephone3 = $request->numero_telephone3;
        $user->profession = $request->profession;
        $user->date_naissance = $request->date_naissance;


        if($user->save()){
            return response()->json(['message' => 'Profile updated successfully'], 200);
        }else {
            return response()->json(['message' => 'Error updating profile'], 500);
        }

    }

    //store

    /**
     *
     * * @OA\Post(
     * *     path="/api/adherents",
     * *     tags={"Adherents"},
     * *     summary="Store a new adherent",
     * *     description="Stores a new adherent with the provided data",
     * *     operationId="storeAdherent",
     *     security={{"bearerAuth":{}}},
     * *
     * *     @OA\RequestBody(
     * *         required=true,
     * *         description="Adherent data for storage",
     * *         @OA\JsonContent(
     *         required={"name", "prenom", "raison_sociale", "civilite", "email", "ville", "adresse", "code_postal", "numero_telephone"},
     *     @OA\Property(property="name", type="string", maxLength=255),
     *     @OA\Property(property="prenom", type="string", maxLength=255),
     *     @OA\Property(property="raison_sociale", type="string", maxLength=255),
     *     @OA\Property(property="civilite", type="string", maxLength=255, enum={"mme", "mr"}),
     *     @OA\Property(property="email", type="string", format="email", maxLength=255),
     *     @OA\Property(property="ville", type="string", maxLength=255),
     *     @OA\Property(property="adresse", type="string", maxLength=255),
     *     @OA\Property(property="code_postal", type="numeric"),
     *     @OA\Property(property="numero_telephone", type="numeric", pattern="/^0[1-9]\d{8}$/"),
     *     @OA\Property(property="numero_telephone2", type="numeric", pattern="/^0[1-9]\d{8}$/", nullable=true),
     *     @OA\Property(property="numero_telephone3", type="numeric", pattern="/^0[1-9]\d{8}$/", nullable=true),
     *     @OA\Property(property="profession", type="string", maxLength=255, nullable=true),
     *     @OA\Property(property="date_naissance", type="date", nullable=true),
     *     @OA\Property(property="photo", type="string", format="binary", maxLength=2048, nullable=true),
     *
     * *         )
     *
     * *     ),
     * *     @OA\Response(response="200", description="Adherent stored successfully"),
     * *     @OA\Response(response="422", description="Validation error"),
     * *     @OA\Response(response="500", description="Error storing adherent"),
     * *
     * * )
     * *
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'raison_sociale' => 'required|string|max:255',
            'civilite' => 'required|string|max:255',
            'email' => 'required|email',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|numeric',
            'numero_telephone' => 'required|numeric|regex:/^0[1-9]\d{8}$/',
            'numero_telephone2' => 'nullable|numeric|regex:/^0[1-9]\d{8}$/',
            'numero_telephone3' => 'nullable|numeric|regex:/^0[1-9]\d{8}$/',
            'profession' => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $adherent = new Adherents();
        $adherent->name = $request->name;
        $adherent->prenom = $request->prenom;
        $adherent->raison_sociale = $request->raison_sociale;
        $adherent->civilite = $request->civilite;
        $adherent->email = $request->email;
        $adherent->ville = $request->ville;
        $adherent->adresse = $request->adresse;
        $adherent->code_postal = $request->code_postal;
        $adherent->numero_telephone = $request->numero_telephone;
        $adherent->numero_telephone2 = $request->numero_telephone2;
        $adherent->numero_telephone3 = $request->numero_telephone3;
        $adherent->profession = $request->profession;
        $adherent->date_naissance = $request->date_naissance;


        if ($adherent->save()) {
            return response()->json(['message' => 'Adherent stored successfully'], 200);
        } else {
            return response()->json(['message' => 'Error storing adherent'], 500);
        }
    }

    /**
     * Get a list of adherents
     *
     * @OA\Get(
     *     path="/api/adherents",
     *     tags={"Adherents"},
     *     summary="Get a list of adherents",
     *     description="Returns a list of all adherents",
     *     operationId="getAdherents",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Adherents::all(), 200);
    }

    //show

    /**
     * Get details of a specific adherent
     *
     * @OA\Get(
     *     path="/api/adherents/{id}",
     *     tags={"Adherents"},
     *     summary="Get details of a specific adherent",
     *     description="Returns details of a specific adherent by ID",
     *     operationId="getAdherentById",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the adherent to retrieve",
     *          required=true,
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(response="404", description="Adherent not found"),
     *
     *  )
     *
     * @param int $id
     * @return Adherents|\Illuminate\Http\JsonResponse
     */
      public function show($id)
     {
         $adherent = Adherents::find($id);

 if (!$adherent) {
             return response()->json(['message' => 'Adherent not found'], 404);
         }

 return response()->json($adherent, 200);
     }


    /**
     * Delete a specific adherent
     *
     * @OA\Delete(
     *     path="/api/adherents/{id}",
     *     tags={"Adherents"},
     *     summary="Delete a specific adherent",
     *     description="Deletes a specific adherent by ID",
     *     operationId="deleteAdherent",
     *      security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the adherent to delete",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(response="200", description="Adherent deleted successfully"),
     *     @OA\Response(response="404", description="Adherent not found"),
     *
     *
     * )
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
public function delete($id)
{
    $adherent = Adherents::find($id);

    if (!$adherent) {
        return response()->json(['message' => 'Adherent not found'], 404);
    }

    $adherent->delete();

    return response()->json(['message' => 'Adherent deleted successfully'], 200);
}
}
