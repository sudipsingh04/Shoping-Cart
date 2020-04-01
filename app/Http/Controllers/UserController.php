<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use Auth;
use Session;

class UserController extends Controller
{
    public function getSignUp()
    {
        return view('user.signup');
    }

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'email'     =>      'email|required|unique:users',
            'password'  =>      'required|min:4'
        ]);

        $user = new User([
            'email' =>  $request->email,
            'password'  =>  bcrypt($request->password)
        ]);

        $user->save();

        Auth::login($user);

        return redirect()->route('shop.index');
    }

    public function getSignIn()
    {
        return view('user.signin');
    }

    public function postSignIn(Request $request)
    {
        $this->validate($request, [
            'email'     =>      'email|required',
            'password'  =>      'required|min:4'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(Session::has('oldUrl')) {
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }
            return redirect()->route('user.profile');
        }
        return redirect()->back();
    }

    public function getProfile()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('user.profile', ['orders' => $orders]);
    }

    public function getLogOut()
    {
        Auth::logout();

        return redirect()->route('user.signin');
    }
}
