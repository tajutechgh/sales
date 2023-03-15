<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Product;
use Cart;
use App\Model\user\Sale_info;
use Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function pos(Request $request)
    {
        $s = $request->input('s');

        $numitems = Cart::count();
        
        $products = Product::latest()->search($s)->paginate(30);

    	return view('user.pos',compact('s','numitems','products'));
    }

    // public function searchItem(Request $request)
    // {
    //     if ($request->ajax()) {

    //     	$output = "";

    //     	$items = Product::where('name','LIKE','%'.$request->search.'%')

    //     	                ->orWhere('brand','LIKE','%'.$request->search.'%')

    //     	                ->get();

    //     	if ($items) {
                
    //             foreach ($items as $key => $item) {

    //             	$output.='<tr>'.
    //     		             '<td>'.$item->name.'</td>'.
    //                          '<td>'.$item->brand.'</td>'.
    //     		             '<td>'.$item->price.'</td>'.
    //     		             '<td>
    //     		             <form method="post" action="'.route('addtocart').'">
    //     		                '.csrf_field().'
    //     		                <input type="hidden" name="productId" value="'.$item->id.'">
    //     		                <input type="text" name="qty" value="1" size="4">
    //     		                <input type="submit" name="" class="btn btn-success btn-sm fa fa-cart-plus" value="add">
    //     		             </form>
    //     		             </td>'.
    //     		             '</tr>';
    //             }

    //             return Response($output);
    //     	}
    //     }
    // }

    public function addtocart(Request $request)  
    {
        $this->validate($request,[

            'qty' => 'required|numeric',
        ]);

        $productId = $request->productId;

        $productById = Product::where('id',$productId)->first(); 

        Cart::add([

        	'id'=>$productId,
        	'name'=>$productById->name,
        	'price'=>$productById->price,
        	'qty'=>$request->qty
        ]);

        return redirect(route('pos'))->with('message','Item added successfully');
    }

    public function cartShow()
    {
    	$cartProducts = Cart::Content();

    	return view('user.showcart',compact('cartProducts'));
    }

    public function updateCart(Request $request)
    {
        Cart::update($request->rowId, $request->qty);

        return redirect(route('showcart'));
    }

    public function removeCartProduct($rowId)
    {
        Cart::remove($rowId);

        return redirect()->back()->with('message','Item removed successfully');
    }

    public function invoice()
    {
        $invoices = Sale_info::latest()->where('user_id','=',Auth::user()->id)->limit(1)->get();

        return view('user.invoice',compact('invoices'));
    }
}