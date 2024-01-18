<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staffs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class StaffsApiAuthController
 * @package App\Http\Controllers\Api
 *
 * @OA\Tag(
 *      name="Staffs Auth",
 *      description="API Endpoints of Staffs Authentification"
 *  )
 *
 */

class StaffsApiAuthController extends Controller
{
    /**
     *
     * @OA\Post(
     *      path="/api/register",
     *      operationId="register",
     *      tags={"Staffs Auth"},
     *      summary="Register a new staff",
     *      description="Register a new staff",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"nom","prenom","email","password","is_admin","structures_id"},
     *              @OA\Property(property="nom", type="string"),
     *              @OA\Property(property="prenom", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *              @OA\Property(property="is_admin", type="boolean"),
     *              @OA\Property(property="structures_id", type="numeric"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Staff Created",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Staff Created"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Invalid Staff Data",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid."),
     *              @OA\Property(property="errors", type="object", example={"nom": {"The nom field is required."}}),
     *          ),
     *      ),
     * )
     */
    public function register(Request $request){
       $request->validate([
            'nom'=>'required|string',
            'prenom'=>'required|string',
            'email'=>'required|string|email|unique:staffs',
            'password'=>'required|min:8',
            'is_admin'=>'required|boolean',
            'structures_id'=>'required|integer',
        ]);
        $staffs = new Staffs();
        $staffs->nom = $request->nom;
        $staffs->prenom = $request->prenom;
        $staffs->email = $request->email;
        $staffs->password = Hash::make($request->password);
        $staffs->is_admin = $request->is_admin;
        $staffs->structures_id = $request->structures_id;
        $staffs->save();

        return response()->json([
            'message' => 'Staff Created ',
        ]);
    }

    /**
     * @OA\Post(
     *      path="/api/login",
     *      operationId="login",
     *      tags={"Staffs Auth"},
     *      summary="Login a staff",
     *      description="Login a staff",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"email","password"},
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Staff Logged",
     *          @OA\JsonContent(
     *              @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Invalid Credentials",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Invalid Credentials"),
     *          ),
     *      ),
     * )
     */


    public function login(Request $request){
        $loginUserData = $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|min:8'
        ]);
        //check email
        $staffs = Staffs::where('email', $loginUserData['email'])->first();

        if(!$staffs || !Hash::check($loginUserData['password'],$staffs->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $staffs->createToken($staffs->name.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }


    /**
     * @OA\Get(
     *      path="/api/user",
     *      operationId="user",
     *      tags={"Staffs Auth"},
     *      summary="Get the current staff",
     *      description="Get the current staff",
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="Staff Logged",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="numeric", example="1"),
     *              @OA\Property(property="nom", type="string", example="John"),
     *              @OA\Property(property="prenom", type="string", example="Doe"),
     *              @OA\Property(property="email", type="string", example="truck@mail.com"),
     *              @OA\Property(property="is_admin", type="boolean", example="false"),
     *              @OA\Property(property="structures_id", type="numeric", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Unauthenticated"),
     *          ),
     *      ),
     * )
     */


    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json([
            "message"=>"logged out"
        ]);
    }
}
