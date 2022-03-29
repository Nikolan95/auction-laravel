<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BidResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data['id'] = $this->id;
        $data['user'] = new UserResource(User::find($this->user_id));
        $data['product'] = new ProductResource(Product::find($this->product_id));
        $data['price'] = $this->price;
        $data['created_at'] = Carbon::parse($this->created_at)->diffForHumans();
        return $data;
    }
}
