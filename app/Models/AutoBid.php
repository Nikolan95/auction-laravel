<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoBid extends Model
{
    use HasFactory;
    protected $table = "auto_bids";
    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'max_value'
    ];
    protected $primaryKey = 'id';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
