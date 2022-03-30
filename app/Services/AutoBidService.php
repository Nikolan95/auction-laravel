<?php

namespace App\Services;

use App\Events\OutBiddedEvent;
use App\Http\Requests\AutoBidRequest;
use App\Models\AutoBid;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AutoBidService
{
    public function storeAutoBid(AutoBidRequest $request, $product, $checkAuto)
    {
        if($checkAuto->max('max_value')){
            $user = User::findOrFail($checkAuto[0]->user_id);
            Bid::where('user_id', $checkAuto[0]->user_id)->where('product_id', $request->input('product_id'))->update(['is_active' => false]);
            if($checkAuto->max('max_value') >= $request->input('max_value')){
                Bid::create([
                    'user_id' => $checkAuto[0]->user_id,
                    'product_id' => $request->input('product_id'),
                    'price' =>  $request->input('max_value') + 1
                ]);
                return 'outbidded';
            }
            else{
                $checkAuto[0]->delete();
                $autobid = AutoBid::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->input('product_id'),
                    'max_value' => $request->input('max_value')
                ]);
                Bid::create([
                    'user_id' => $checkAuto[0]->user_id,
                    'product_id' => $request->input('product_id'),
                    'price' =>  $checkAuto[0]->max_value + 1
                ]);
                    event(new OutBiddedEvent($user, $product));
                return 'outbid';
            }
        }
        else{
            AutoBid::create([
                'user_id' => Auth::id(),
                'product_id' => $request->input('product_id'),
                'max_value' => $request->input('max_value')
            ]);
            Bid::where('user_id', Auth::id())->where('product_id', $request->input('product_id'))->update(['is_active' => false]);

            Bid::create([
                'user_id' => Auth::id(),
                'product_id' => $request->input('product_id'),
                'price' => $product->highestBid() ? $product->highestBid() + 1 : $product->start_price
            ]);
            return 'success';
        }
    }
}
