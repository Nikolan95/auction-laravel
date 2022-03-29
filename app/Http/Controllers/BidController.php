<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutoBidRequest;
use App\Http\Requests\StoreBidRequest;
use App\Models\AutoBid;
use App\Models\Product;
use App\Services\AutoBidService;
use App\Services\CreateBidService;

class BidController extends Controller
{
    public function store(StoreBidRequest $request)
    {
        (new CreateBidService())->storeBid($request);

        return redirect()->back()->with('newbid', 'newbid');
    }
    public function autobid(AutoBidRequest $request)
    {
        $product = Product::findOrFail($request->input('product_id'));
        $checkAuto = AutoBid::where('product_id', $request->input('product_id'))->get();
        $bid =  (new AutoBidService())->storeAutoBid($request, $product, $checkAuto);
        if($bid == 'outbidded'){
            return redirect()->back()->with('outbidded', 'outbidded');
        }
        elseif($bid == 'outbid'){
            return redirect()->back()->with('outbid', 'outbid');
        }
        else{
            return redirect()->back()->with('success', 'success');
        }
    }
}
