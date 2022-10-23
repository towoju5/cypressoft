<?php

namespace App\Http\Controllers;

use App\Models\Coins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $coins = Coins::where('user_id', Auth::id())->get();
        return view('home', compact('coins'));
    }

}
