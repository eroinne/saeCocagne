<?php

namespace App\Http\Controllers\Api;

use App\Models\Staffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Tag(
 *     name="Staffs",
 *     description="API Endpoints of Staffs Controller"
 * )
 *
 * Class StaffsController
 * @package App\Http\Controllers\Api
 */
class StaffsController
{
    /**
     * @OA\Get(
     *     path="/api/staffs",
     *     tags={"Staffs"},
     *     summary="Get a list of staffs",
     *     description="Returns a list of staffs",
     *     operationId="getStaffs",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *
     * )
     */
    public function index()
    {
        return Staffs::all();
    }

    /**
     * @OA\Get(
     *     path="/api/staffs/{id}",
     *     tags={"Staffs"},
     *     summary="Get a staff member",
     *     description="Returns a staff member by ID",
     *     operationId="getStaffById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the staff member",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Staff member not found",
     *     ),
     *
     * )
     */
    public function show($id)
    {
        $staff = Staffs::find($id);
        if ($staff) {
            return $staff;
        } else {
            return response()->json(['message' => 'Staff member not found'], 404);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/staffs/{id}",
     *     tags={"Staffs"},
     *     summary="Delete a staff member",
     *     description="Deletes a staff member by ID",
     *     operationId="deleteStaff",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the staff member",
     *         required=true,
     *         @OA\Schema(type="integer", format="int64")
     *     ),
     *     @OA\Response(response="200", description="Successful operation"),
     *     @OA\Response(response="404", description="Staff member not found"),
     *
     * )
     */
    public function delete($id)
    {
        $staff = Staffs::find($id);

        if (!$staff) {
            return response()->json(['message' => 'Staff member not found'], 404);
        }

        $staff->delete();

        return response()->json(['message' => 'Staff member deleted successfully'], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/staffs/{id}",
     *     tags={"Staffs"},
     *     summary="Update a staff member",
     *     description="Updates a staff member's account",
     *     security={{"bearerAuth":{}}},
     *          @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID du staffs à mettre à jour",
     *          required=true,
     *          @OA\Schema(type="integer", format="int64")
     *      ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Staff data for update",
     *         @OA\JsonContent(
     *     required={"nom","prenom","email"},
     *     @OA\Property(property="nom", type="string"),
     *     @OA\Property(property="prenom", type="string"),
     *     @OA\Property(property="email", type="string"),
     *     )
     *     ),
     *     @OA\Response(response="200", description="Successful operation", @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="Staff member updated successfully")
     *    )
     *     ),
     *     @OA\Response(response="422", description="Validation error", @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="Error updating staff member")
     *   )
     *     ),
     *
     *
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $staff = Staffs::find($id);
        if (!$staff) {
            return response()->json(['message' => 'Staff member not found'], 404);
        }

        $staff->nom = $request->nom;
        $staff->prenom = $request->prenom;
        $staff->email = $request->email;

        if ($staff->save()) {
            return response()->json(['message' => 'Staff member updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Error updating staff member'], 500);
        }
    }

    //store a staff member

    /**
     * @OA\Post(
     *     path="/api/staffs",
     *     tags={"Staffs"},
     *     summary="Store a staff member",
     *     description="Stores a staff member",
     *     operationId="storeStaff",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Staff data for store",
     *         @OA\JsonContent(
     *         required={"nom","prenom","email","password","structures_id","is_admin"},
     *     @OA\Property(property="nom", type="string"),
     *     @OA\Property(property="prenom", type="string"),
     *     @OA\Property(property="email", type="string"),
     *     @OA\Property(property="password", type="string"),
     *     @OA\Property(property="structures_id", type="integer"),
     *     @OA\Property(property="is_admin", type="boolean"),
     *     )
     *
     *     ),
     *     @OA\Response(response="200", description="Successful operation", @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="Staff member created successfully")
     *     )
     * ),
     *     @OA\Response(response="422", description="Validation error", @OA\JsonContent(
     *         @OA\Property(property="message", type="string", example="Error creating staff member")
     *    )
     *     ),
     *
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|max:255',
            'structures_id' => 'required|integer',
            'is_admin' => 'required|boolean',
        ]);

        $staff = new Staffs();
        $staff->nom = $request->nom;
        $staff->prenom = $request->prenom;
        $staff->email = $request->email;
        $staff->password = bcrypt($request->password);
        $staff->structures_id = $request->structures_id;
        $staff->is_admin = $request->is_admin;
        $result = $staff->save();

        if ($result) {
            return response()->json(['message' => 'Staff member created successfully'], 200);
        } else {
            return response()->json(['message' => 'Error creating staff member'], 500);
        }
    }
}
