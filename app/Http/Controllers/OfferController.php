<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferCollection;
use App\Http\Resources\OfferPage;
use App\Offer;
use App\Providers\RouteServiceProvider;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function createOffer(Sale $item, Request $request){

        $item->offers()->create([
            'token' => md5(uniqid().Auth::id()),
            'from' => Auth::id(),
            'offer' => $request->offer
        ]);

        return response()->json([
            'msg' => 'Offer made to this item'
        ], 201);
    }

    public function getOffers(Sale $item, Request $request)
    {
        if ($item->is_public || $item->i_am_seller){
            return new OfferCollection($item->offers()->paginate());
        }
        return [];
    }

    public function showOffer(Request $request, Sale $item, Offer $offer)
    {
        $item->offers()->findOrFail($offer->id);
        return view(RouteServiceProvider::VIEWS['offer']);
    }

    public function getOfferDetails(Request $request, Sale $item, Offer $offer)
    {
        $item->offers()->findOrFail($offer->id);
        return new OfferPage($offer);
    }

    public function closeOffer(Request $request, Sale $item, Offer $offer, $token)
    {
        $item->offers()->findOrFail($offer->id);
        $user = User::find(Auth::id());
        if ($user->generateToken('close offer') == $token){
            $offer->closeOffer($request->reason);

            return response()->json([
                'msg' => "Offer has been closed"
            ], 201);
        }else{
            return response()->json([
                'msg' => "You do not have authorization to perform this action"
            ], 403);
        }
    }
}
