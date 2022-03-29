<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'start_price',
        'auction_ends'
    ];
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function image(){
        return $this->hasOne(ProductImage::class);
    }
    public function bids(){
        return $this->hasMany(Bid::class);
    }
    public function autoBids(){
        return $this->hasMany(AutoBid::class);
    }
    public function highestBid(){
        return $this->bids()->max('bids.price');
    }
    public function highestBidUser(){
        return $this->bids()->where('bids.price', $this->highestBid())->with('user')->first();
    }
}
