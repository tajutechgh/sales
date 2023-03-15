<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\user\Sale;
use App\Model\user\Product;
use App\Model\user\User;
use Carbon\Carbon;
use App\Model\user\Sale_info;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Product::latest()->where('status', '=', 0)->limit(5)->get();

        $productsAvailable = Product::where('status', '=', 1)->count();

        $productsFinished = Product::where('status', '=', 0)->count();

        $totalesales = Sale_info::whereDate('created_at', Carbon::today())->count();

        return view('user.home',compact('items','productsAvailable','productsFinished','totalesales'));
    }
    
}
