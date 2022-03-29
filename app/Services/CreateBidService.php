<?php

namespace App\Services;

use App\Http\Requests\StoreBidRequest;
use App\Models\Bid;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CreateBidService
{
    public function storeBid(StoreBidRequest $request)
    {
        Bid::where('user_id', Auth::id())->where('product_id', $request->input('product_id'))->update(['is_active' => false]);

        $bid = Bid::create([
            'user_id' => Auth::id(),
            'product_id' => $request->input('product_id'),
            'price' => $request->input('price')
        ]);
        $product = Product::where('id', $request->input('product_id'))->with('autobids')->first();
        if(count($product->autoBids) != 0){
            foreach($product->autoBids as $autoBid){
                if($bid->price < $autoBid->max_value && $bid->user_id != $autoBid->user_id){
                    Bid::where('user_id', $autoBid->user_id)->where('product_id', $autoBid->product_id)->update(['is_active' => false]);
                    Bid::create([
                        'user_id' => $autoBid->user_id,
                        'product_id' => $autoBid->product_id,
                        'price' => $bid->price + 1,
                    ]);
                }
            }
        }
        return $bid;
    }
}
