<?php

namespace App\Http\Controllers;

use App\Facades\SalesImage as FacadesSalesImage;
use App\Http\Requests\SaveSale;
use App\Http\Resources\SaleCollection;
use App\Providers\RouteServiceProvider;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function showForm(Request $request)
    {
        return view(RouteServiceProvider::VIEWS['sell']);
    }

    public function saveSale(SaveSale $request)
    {
        $sale = Sale::create([
            'token' => md5(uniqid().Auth::id()),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->amount,
            'seller_id' => Auth::id(),
            'phone' => $request->phone,
            'category' => $request->category,
            'is_public' => $request->has('public_negotiation')
        ]);

        foreach ($request->location as $location) {
            $sale->locations()->create([
                'item_id' => $sale->id,
                'state' => $location['state'],
                'location' => $location['region']
            ]);
        }

        foreach ($request->attachment as $attachment) {
            $paths = FacadesSalesImage::upload($attachment['image'], $sale);

            $sale->images()->create([
                'image_token' => $paths['full'],
                'preview_token' => $paths['preview'],
                'caption' => $attachment['caption']
            ]);
        }

        return response()->json([
            'msg' => 'Sales was successful',
        ], 201);
    }

    public function showMarket(Request $request, $type = "all")
    {
        return view(RouteServiceProvider::VIEWS['market'], []);
    }

    public function getSales(Request $request, $type = "all")
    {
        $item_obj = new Sale;
        if ($request->state || (Auth::check() && Auth::user()->profile->state)){
            $item_obj = $item_obj->fromState($request->state ?? Auth::user()->profile->state);
        }
        if ($request->category){
            $item_obj = $item_obj->inCategory($request->category);
        }
        if ($request->search){
            $item_obj = $item_obj->searchFor($request->search);
        }
        if (!$request->hasAny(['state', 'category', 'search'])){
            //
        }
        $item_obj = $item_obj->loadAll();

        return new SaleCollection($item_obj->paginate(3));
    }
}
