<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Sale;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Cart;
use App\Model\user\Sale_info;
use Auth;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $sales = Sale_info::whereDate('created_at', Carbon::today())->get();

        return view('user.sale.index',compact('sales'));
    }

    public function create() 
    {
        //
    }

    public function store(Request $request)
    {
        $sale = new Sale_info;

        $sale->total=$request->total;
        $sale->invoice_number=$request->invoice_number;
        $sale->user_id=Auth::user()->id;

        if ($sale->save()) {

            $id = $sale->id;

            foreach ($request->name as $key => $value) {

                $data = array('saleInfo_id'=>$id,
                              'name'=>$value,
                              'qty'=>$request->qty[$key],
                              'price'=>$request->price[$key],
                              'total_amount'=>$request->total_amount[$key]);
                Sale::insert($data);
            }
        }

        Cart::destroy();

        return redirect(route('invoice'));
    }

    public function show($id)
    {
        $saleInfo = Sale_info::find($id);

        $sales = Sale_info::find($id)->sales;

        return view('user.sale.show',compact('saleInfo','sales')); 
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
