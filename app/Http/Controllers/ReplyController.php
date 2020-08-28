<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyCollection;
use App\Offer;
use App\Reply;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function createReply(Sale $item, Offer $offer, Request $request)
    {
        $item->offers()->findOrFail($offer->id);
        $offer->replies()->create([
            'token' => md5(uniqid().Auth::id()),
            'from' => Auth::id(),
            'reply' => $request->reply
        ]);

        return response()->json([
            'msg' => 'Reply Sent'
        ], 201);
    }

    public function getReplies(Sale $item, Offer $offer, Request $request)
    {
        $item->offers()->findOrFail($offer->id);
        return new ReplyCollection($offer->replies()->paginate());
    }

    public function editReply(Sale $item, Offer $offer, Reply $reply, $token, Request $request)
    {
        $item->offers()->findOrFail($offer->id)->replies()->findOrFail($reply->id);
        $user = User::find(Auth::id());
        if ($user->generateToken('edit reply') == $token){
            $reply->before_edit = $reply->reply;
            $reply->reply = $request->edit;
            $reply->save();

            return response()->json([
                'msg' => "Your reply has been edited"
            ], 201);
        }else{
            return response()->json([
                'msg' => "You do not have authorization to perform this action"
            ], 403);
        }
    }

    public function deleteReply(Sale $item, Offer $offer, Reply $reply, $token, Request $request)
    {
        $item->offers()->findOrFail($offer->id)->replies()->findOrFail($reply->id);
        $user = User::find(Auth::id());
        if ($user->generateToken('delete reply') == $token){
            $reply->delete();

            return response()->json([
                'msg' => "Response deleted"
            ], 201);
        }else{
            return response()->json([
                'msg' => "You do not have authorization to perform this action"
            ], 403);
        }
    }
}
