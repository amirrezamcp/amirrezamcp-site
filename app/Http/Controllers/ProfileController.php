<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show()
    {
        $userProfile =  Profile::first();

        if(is_null($userProfile)) {
            $response = [
                'status' => false,
                'message' => 'not profaile'
            ];
            return response()->json($response, 401);
        }

        return response()->json([
            "status" => true,
            "message" => "profile information",
            "data" => $userProfile
        ]);
    }
    public function update(ProfileRequest $request): JsonResponse
    {
        $data = $request->validated();

        $profile = Profile::firstOrCreate([], $data);

        if (!$profile->wasRecentlyCreated) {
            $profile->update($data);
        }

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully.',
            'data' => $profile,
        ]);
    }
}
