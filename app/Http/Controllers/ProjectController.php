<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::all();
        if($project->isEmpty()) {
            $response = [
                'status' => false,
                'message' => 'not project'
            ];
            return response()->json($response, 401);
        }

        return response()->json([
            "status" => true,
            "message" => "project information",
            "data" => $project
        ]);
    }
}
