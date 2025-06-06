<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $service = Service::all();

        if($service->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'سرویسی وجود ندارد'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'سرویس ها با موفقیت بارگذاری شدند',
            'data' => $service
        ]);
    }
    public function store(ServiceRequest $request)
    {
        $data = $request->validated();
        $service = Service::create($data);

        return response()->json([
            'status' => true,
            'message' => 'سرویس شما با موفقیت ارسال شد.',
            'data' => $service,
        ], 201);
    }
}
