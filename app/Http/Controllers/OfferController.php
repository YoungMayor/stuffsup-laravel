<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferCollection;
use App\Http\Resources\OfferPage;
use App\Offer;
use App\Providers\RouteServiceProvider;
use App\Sale;
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
}
