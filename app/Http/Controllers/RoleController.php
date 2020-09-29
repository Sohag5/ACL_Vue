<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Helpers\CheckPermission;

class RoleController extends Controller
{
    use CheckPermission;
    
    public function __construct()
    {
        $this->route = \Request::route()->getName();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->checkPermission('role', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        $role =  Role::paginate(20);
        return response()->json(['message' => 'success','data' => $role,'code' => 2000]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->checkPermission('role', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        $obj = new Role;
        $data = $obj::create([
            'role_name'=>$request->role_name,
        ]);
        if($data){
            return response()->json(['message' => 'Role Created Successfully ',$data,'code' => 2000]);
        }else{
            return response()->json(['message' => 'Something went wrong','code' => 3000]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($this->checkPermission('role', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        $obj = new Role;
        $data = $obj::where('id',$id)->update([
            'role_name'=>$request->role_name,
        ]);
        if($data){
            return response()->json(['message' => 'Role Updated Successfully ',$data,'code' => 2000]);
        }else{
            return response()->json(['message' => 'Something went wrong','code' => 3000]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkPermission('role', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        $check = User::where('role',$id)->first();
        if($check){
            return response()->json(['message' => 'Delete is Not possible , This Role Exit On User','code' => 3000]);
        }else{
            $role = Role::destroy($id);
            if($role){
                return response()->json(['message' => 'Role Deleted Successfully ','code' => 2000]);
            }else{
                return response()->json(['message' => 'Something went wrong','code' => 3000]);
            }
        }

    }
}
