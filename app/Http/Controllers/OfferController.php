<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfferCollection;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function createOffer(Sale $item, Request $request){

        $item->offers()->create([
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
}
