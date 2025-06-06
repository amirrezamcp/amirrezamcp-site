<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    public function store(MessageRequest $request): JsonResponse
    {
        $data = $request->validated();
        $message = Message::create($data);

        return response()->json([
            'status' => true,
            'message' => 'پیام شما با موفقیت ارسال شد.',
            'data' => $message,
        ], 201);
    }
}
