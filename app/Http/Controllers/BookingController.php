<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/bookings",
     *     tags={"Bookings"},
     *     summary="Book a classroom",
     *     description="Book a classroom for a specific time slot",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="classroom_id", type="integer", example=1),
     *             @OA\Property(property="start_time", type="string", example="2024-08-10 10:00:00"),
     *             @OA\Property(property="attendees", type="integer", example=5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Class booked successfully",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function book(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'classroom_id' => 'required|exists:classrooms,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'attendees' => 'required|integer',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Fetch classroom details
        $classroom = DB::select('SELECT * FROM classrooms WHERE id = ?', [$request->classroom_id])[0];
        $startTime = Carbon::parse($request->start_time);
        $endTime = $startTime->copy()->addMinutes($classroom->interval * 60);

        // Check if the booking time is in the past
        if ($startTime->isBefore(Carbon::now())) {
            return response()->json(['error' => 'Cannot book a class in the past'], 400);
        }

        // Check if the booking time is within the classroom's operating hours
        if ($startTime->format('H:i') < $classroom->start_time || $endTime->format('H:i') > $classroom->end_time) {
            return response()->json(['error' => 'Class time out of bounds'], 400);
        }

        // Check if the number of attendees does not exceed the classroom capacity
        if ($request->attendees > $classroom->capacity) {
            return response()->json(['error' => 'Attendees exceed classroom capacity'], 400);
        }

        // Insert booking record into the database
        DB::insert('INSERT INTO bookings (classroom_id, start_time, end_time, attendees, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())', [
            $classroom->id, $startTime, $endTime, $request->attendees
        ]);

        return response()->json(['success' => 'Class booked successfully'], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/bookings/{id}",
     *     tags={"Bookings"},
     *     summary="Cancel a booking",
     *     description="Cancel a previously booked class",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking canceled successfully",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Booking not found"
     *     )
     * )
     */
    public function cancel(Request $request, $id)
    {
        // Fetch booking details
        $booking = DB::select('SELECT * FROM bookings WHERE id = ?', [$id]);

        // Check if booking exists
        if (empty($booking)) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $booking = $booking[0];
        $diff = Carbon::now()->diffInHours(Carbon::parse($booking->start_time));

        // Check if the cancellation request is made at least 24 hours in advance
        if ($diff < 24) {
            return response()->json(['error' => 'Cannot cancel a class less than 24 hours in advance'], 400);
        }

        // Delete booking record from the database
        DB::delete('DELETE FROM bookings WHERE id = ?', [$id]);

        return response()->json(['success' => 'Booking canceled successfully'], 200);
    }
}
