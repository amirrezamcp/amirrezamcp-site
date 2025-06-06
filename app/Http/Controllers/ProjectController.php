<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::all();

        if($projects->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'پروژه‌ای وجود ندارد'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'پروژه‌ها با موفقیت بارگذاری شدند',
            'data' => $projects
        ]);
    }

    public function store(ProjectRequest $request): JsonResponse
    {
        $data = $request->validated();

        $project = Project::create($data);

        return response()->json([
            'status' => true,
            'message' => 'پروژه با موفقیت ثبت شد',
            'data' => $project,
        ], 201);
    }
}
