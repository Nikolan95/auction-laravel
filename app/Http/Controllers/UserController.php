<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddBalanceRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Bid;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function login(){
        return view('auth.login');
    }
    public function loginUser(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('products')->with('success', 'login success');
        }
        return back()->with('error', 'Wrong credentials');
    }
    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'password' => Hash::make($request->input('password')),
        ]);

        if($user->save()){
            Auth::loginUsingId($user->id);
            return redirect()->route('products');
        }
    }
    public function profile()
    {
        $bids = Bid::latest()->take(15)->with('user')->with('product')->get();
        $notifications = auth()->user()->unreadNotifications;
        return view('user.profile',[
            'user' => Auth::user(),
            'bids' => $bids,
            'notifications' => $notifications
        ]);
    }
    public function addBalance(AddBalanceRequest $request)
    {
        if(isset($request->validator) && $request->validator->fails()){
            return response()->json(['status' => 0, 'error' => $request->validator->errors()->toArray()]);
        }
        User::findOrFail(Auth::id())->increment('balance', $request->input('balance'));

        return response()->json(Auth::user()->balance + $request->input('balance'));
    }
    public function readNotification(Request $request)
    {
        Auth::user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request){
                return $query->where('id', $request->input('id'));
            })->markAsRead();

        return Response()->noContent();
    }
}
