<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewCollection;
use App\Http\Resources\SaleCollection;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile(User $user, Request $request)
    {
        return view(RouteServiceProvider::VIEWS['profile'], [
            'user' => $user
        ]);
    }

    public function selfProfile(Request $request)
    {
        return view(RouteServiceProvider::VIEWS['profile'], [
            'user' => Auth::user()
        ]);
    }

    protected function getSales()
    {
        //
    }

    public function peekMarket(Request $request, User $user)
    {
        return new SaleCollection($user->sales()->ongoingSales()->inRandomOrder()->limit(3)->get());
    }

    public function peekReviews(User $user, Request $request)
    {
        return new ReviewCollection($user->reviews_received()->inRandomOrder()->limit(3)->get());
    }

    public function showEditor(Request $request)
    {
        //
    }
}
