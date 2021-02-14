<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    private User $user;

    /**
     * Dependency Injection
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $users = $this->user
            ->ofText($request->search)
            ->get();

        return response()->json([
            'message' => 'Users fetched successfully.',
            'data' => [
                'users' => $users
            ]
        ]);
    }
}
