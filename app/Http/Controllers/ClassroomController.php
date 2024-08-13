<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Info(title="Classroom Booking API", version="1.0")
 */
class ClassroomController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/classrooms",
     *     tags={"Classrooms"},
     *     summary="Get list of all classrooms",
     *     description="Returns list of classrooms",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     )
     * )
     */
    public function index()
    {
        // Manually write SQL query to fetch all classrooms
        $classrooms = DB::select('SELECT * FROM classrooms');
        
        return response()->json($classrooms);
    }
}
