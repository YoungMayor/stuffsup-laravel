<?php

namespace App\Http\Controllers;

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
}
