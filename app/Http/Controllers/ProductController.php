<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
       $products = Product::where('auction_ends', '>', now())->with('image')->paginate(8);
       $notifications = auth()->user()->unreadNotifications;
        return view('products.all', [
            'products' => $products,
            'notifications' => $notifications
        ]);
    }
    public function filterPrice($fitler)
    {
        if($fitler == 'lowest'){
            $products = Product::where('auction_ends', '>', now())->with('image')->orderBy('start_price', 'asc')->paginate(8);
            $notifications = auth()->user()->unreadNotifications;
            return view('products.all', [
                'filter' => $fitler,
                'notifications' => $notifications,
                'products' => $products
            ]);
        }
        elseif($fitler == 'highest'){
            $products = Product::where('auction_ends', '>', now())->with('image')->orderBy('start_price', 'desc')->paginate(8);
            $notifications = auth()->user()->unreadNotifications;
            return view('products.all', [
                'filter' => $fitler,
                'notifications' => $notifications,
                'products' => $products
            ]);
        }
        else{
            return redirect()->route('products');
        }
    }
    public function show($id)
    {
        $product = Product::where('id', $id)->with('image')->with(['bids' => function ($q) {
            $q->with('user')->orderBy('created_at', 'desc')->limit(15);
        }])->firstorfail();
        $notifications = auth()->user()->unreadNotifications;
        $maxBid = $product->bids->max('price');
        return view('products.detail', [
            'product' => $product,
            'notifications' => $notifications,
            'maxBid' => $maxBid
        ]);
    }
    public function search()
    {
        if(isset($_GET['searchquery'])){
            $searchText = $_GET['searchquery'];
            $notifications = auth()->user()->unreadNotifications;
            $products = Product::where('auction_ends', '>', now())
                ->where('name', 'LIKE', '%'. $searchText . '%')
                ->orWhere('description', 'LIKE', '%'. $searchText . '%')->with('image')->paginate(8);
            return view('products.all', [
                'notifications' => $notifications,
                'products' => $products
            ]);
        }
    }
}
