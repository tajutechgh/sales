<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Sale;
use Illuminate\Support\Facades\Input;
use App\Model\user\Sale_info;

class ViewController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function salesReport()
    {
        return view('user.salesreport');
    }

    public function searchsalesReport()
    {

        $startdate = Input::get('startdate');

        $enddate = Input::get('enddate');

        $sale = Sale_info::whereBetween('created_at', [$startdate,$enddate])->get();

        if (count($sale) > 0) {

            return view('user.salesreport')->withDetails($sale)->withQuery($startdate,$enddate); 
        }

        return view('user.salesreport')->withMessage('No sales available!'); 
    }

    public function saleDetails($id)
    {
        $saleInfo = Sale_info::find($id);

        $sales = Sale_info::find($id)->sales;

        return view('user.salesdetails',compact('saleInfo','sales'));
    }
}
