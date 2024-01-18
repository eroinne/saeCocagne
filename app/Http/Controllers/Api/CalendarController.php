<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calendriers;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Calendriers",
 *     description="API Endpoints of Calendar Controller"
 * )
 * Class CalendarController
 * @package App\Http\Controllers\Api
 */
class CalendarController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/calendrier",
     *     summary="Add a new calendar",
     *     tags={"Calendriers"},
     *     description="Add a new calendar for a structure",
     *     operationId="addNewCalendar",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"structures_id", "annee", "semaines_non_livrable", "tournee_id"},
     *             @OA\Property(property="structures_id", type="numeric"),
     *             @OA\Property(property="annee", type="numeric"),
     *             @OA\Property(property="semaines_non_livrable", type="string"),
     *             @OA\Property(property="tournee_id", type="numeric"),
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
            'annee' => 'required|numeric',
            'semaines_non_livrable' => 'required|string',
            'tournee_id' => 'required|numeric',
        ]);

        $calendar = new Calendriers();
        $calendar->structures_id = $request->structures_id;
        $calendar->annee = $request->annee;
        $calendar->semaines_non_livrable = $request->semaines_non_livrable;
        $calendar->tournee_id = $request->tournee_id;

        $result = $calendar->save();

        if ($result) {
            return response()->json($calendar, 201);
        } else {
            return response()->json(['message' => 'Operation failed'], 404);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/calendrier/{id}",
     *     summary="Update a calendar",
     *     tags={"Calendriers"},
     *     description="Update details of a calendar by ID",
     *     operationId="updateCalendar",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the calendar to update",
     *         required=true,
     *         @OA\Schema(type="numeric")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"structures_id", "annee", "semaines_non_livrable", "tournee_id"},
     *             @OA\Property(property="structures_id", type="numeric"),
     *             @OA\Property(property="annee", type="numeric"),
     *             @OA\Property(property="semaines_non_livrable", type="string"),
     *             @OA\Property(property="tournee_id", type="numeric"),
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
            'structures_id' => 'required|numeric',
            'annee' => 'required|numeric',
            'semaines_non_livrable' => 'required|string',
            'tournee_id' => 'required|numeric',
        ]);

        $calendar = Calendriers::find($id);
        $calendar->structures_id = $request->structures_id;
        $calendar->annee = $request->annee;
        $calendar->semaines_non_livrable = $request->semaines_non_livrable;
        $calendar->tournee_id = $request->tournee_id;

        $result = $calendar->save();

        if ($result) {
            return response()->json($calendar, 200);
        } else {
            return response()->json(['message' => 'Operation failed'], 404);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/calendrier/{id}",
     *     summary="Delete a calendar",
     *     tags={"Calendriers"},
     *     description="Delete a calendar by ID",
     *     operationId="deleteCalendar",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the calendar to delete",
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
        $calendar = Calendriers::find($id);

        if ($calendar) {
            $result = $calendar->delete();

            if ($result) {
                return response()->json(['message' => 'Operation successful'], 200);
            }
        }

        return response()->json(['message' => 'Calendar not found'], 404);
    }

    //index
    /**
     * @OA\Get(
     *     path="/api/calendrier",
     *     summary="Get all calendars",
     *     tags={"Calendriers"},
     *     description="Get all calendars",
     *     operationId="getAllCalendars",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *
     *     ),
     *     @OA\Response(response=404, description="No calendars found")
     * )
     */
    public function index()
    {
        $calendars = Calendriers::all();

        if ($calendars->isEmpty()) {
            return response()->json(['message' => 'No calendars found'], 404);
        }

        return response()->json($calendars, 200);
    }


    //show
    /**
     * @OA\Get(
     *     path="/api/calendrier/{id}",
     *     summary="Get a calendar",
     *     tags={"Calendriers"},
     *     description="Get a calendar by ID",
     *     operationId="getCalendarById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the calendar to return",
     *         required=true,
     *         @OA\Schema(type="numeric")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *
     *     ),
     *     @OA\Response(response=404, description="Calendar not found")
     * )
     */
    public function show($id)
    {
        $calendar = Calendriers::find($id);

        if ($calendar) {
            return response()->json($calendar, 200);
        }

        return response()->json(['message' => 'Calendar not found'], 404);
    }

}
