<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $products = Product::all();

        return view('user.product.index',compact('products'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'name' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'quantity' => 'required',
            'description' => 'required',
            'image' => 'required',

        ]);
        
        if ($request->hasFile('image')) {

            $imageName = $request->image->getClientOriginalName();

            $request->image->storeAs('public',$imageName);

            $request->status? : $request['status']=0;

            $product = new Product;

            $product->name = $request->name;
            $product->price = $request->price;
            $product->brand = $request->brand;
            $product->quantity = $request->quantity;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->image = $imageName;

            $product->save();
        }

        return redirect(route('product.index'))->with('message','Item added successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[

            'name' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'quantity' => 'required',
            'description' => 'required',

        ]);

        $request->status? : $request['status']=0;
        
        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->status = $request->status;

        $product->save();

        return redirect(route('product.index'))->with('message','Item updated successfully');
    }

    public function destroy($id)
    {
        Product::where('id',$id)->delete();

        return redirect()->back()->with('message','Item deleted successfully');
    }
}
