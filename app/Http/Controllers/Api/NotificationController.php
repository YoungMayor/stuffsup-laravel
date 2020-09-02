<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationCollection;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotificationCount(Request $request, User $user)
    {
        if ($user->id !== Auth::id()){
            return response()->json([
                'title' => "Invalid Request",
                'msg' => "You are not authorized to access the requested resource"
            ], 401);
        }

        $count = $user->unreadNotifications()->count();
        return $count > 100 ? "99+" : $count;
    }

    public function getNotifications(Request $request, User $user)
    {
        if ($user->id !== Auth::id()){
            return response()->json([
                'title' => "Invalid Request",
                'msg' => "You are not authorized to access the requested resource"
            ], 401);
        }

        return new NotificationCollection($user->notifications()->paginate(3));
    }
}
