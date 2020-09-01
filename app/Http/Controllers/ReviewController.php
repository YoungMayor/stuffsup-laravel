<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReview;
use App\Http\Resources\ReviewCollection;
use App\Review;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function createReview(User $user, CreateReview $request)
    {
        $review = Review::where([
            'user_id' => $user->id,
            'reviewer_id' => Auth::id()
        ])->first();

        if ($review) {
            $updated = true;
        } else {
            $review = Review::make([
                'user_id' => $user->id,
                'reviewer_id' => Auth::id()
            ]);
            $updated = false;
        }
        $review->token = md5(uniqid() . Auth::id());
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();

        return response()->json([
            'title' => 'Thanks for your review',
            'msg' => $updated
                ? 'Your review on this user has been updated'
                : 'Review has been submitted',
        ], 201);
    }

    public function getReviews(User $user, Request $request)
    {
        //
    }
}
