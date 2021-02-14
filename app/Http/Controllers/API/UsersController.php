<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    /**
     * Get all users or by search.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $users = User::ofText($request->search)
            ->get();

        return response()->json([
            'message' => 'Users fetched successfully.',
            'data' => [
                'users' => $users
            ]
        ]);
    }
}
