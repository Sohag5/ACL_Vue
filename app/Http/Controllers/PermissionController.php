<?php

namespace App\Http\Controllers;

use App\Http\Helpers\CheckPermission;
use App\Models\Menu;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        if($this->checkPermission('permission', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        $output['menu'] = Menu::all();
        $output['role'] = Role::all();
        return response()->json(['message' => 'success','data' => $output,'code' => 2000]);
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
    
        if($this->checkPermission('permission', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        
        $check = Permission::where('role',$request->role)->first();
        if($check){
            Permission::where('role',$request->role)->delete();
        }
        $menu = Menu::all();
        $data =[];
        foreach ($menu as $key => $val){
            $data[]=[
               'menu_name' => $val->slug,
               'menu_id' => $val->id,
               'role' => $request->role,
               'show' => in_array($val->id, $request->show) ? '1' : '0',
               'create' => in_array($val->id, $request->create) ? '1' : '0',
               'edit' => in_array($val->id, $request->edit) ? '1' : '0',
               'insert' => in_array($val->id, $request->insert) ? '1' : '0',
               'update' => in_array($val->id, $request->update) ? '1' : '0',
               'delete' => in_array($val->id, $request->delete) ? '1' : '0',
               'view' => in_array($val->id, $request->view) ? '1' : '0',
            ];

        }
        
        Permission::insert($data);
        if($data){
            return response()->json(['message' => 'Permission Created Successfully ',$data,'code' => 2000]);
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
        if($this->checkPermission('permission', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        $output['permission'] = Permission::where('role',$id)->get();
        return response()->json(['message' => 'success','data' => $output,'code' => 2000]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
