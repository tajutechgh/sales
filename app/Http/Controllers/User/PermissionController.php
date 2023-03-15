<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Permission;

class PermissionController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $permissions = Permission::all();

        return view('user.permission.index',compact('permissions'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request,[

            'name'=>'required',
            'for'=>'required',

        ]);

        $permission = new Permission;

        $permission->name=$request->name;
        $permission->for=$request->for;

        $permission->save();

        return redirect(route('permission.index'))->with('message','Permission added successfully');
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

            'name'=>'required',
            'for'=>'required',

        ]);

        $permission = Permission::find($id);

        $permission->name=$request->name;
        $permission->for=$request->for;

        $permission->save();

        return redirect(route('permission.index'))->with('message','Permission updated successfully'); 
    }

    public function destroy($id)
    {
        Permission::where('id',$id)->delete();

        return redirect()->back()->with('message','Permission deleted successfully');
    }
}
