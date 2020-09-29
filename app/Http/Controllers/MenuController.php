<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Menu;
use DB;
use Auth;
use Illuminate\Support\Str;
use App\Http\Helpers\CheckPermission;

class MenuController extends Controller
{
    use CheckPermission;
    
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->route = \Request::route()->getName();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->checkPermission('menu', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        $menu =  Menu::paginate(20);
        return response()->json(['message' => 'success','data' => $menu,'code' => 2000]);

    }
    
    
    public function allMenu()
    {

//        $menu =  Menu::all();
//        $data="<ul class=\"navbar-nav\">";
//        foreach ($menu as $key =>$menu){
//            $dropMenu = Menu::where('parent',$menu->id)->get();
//            if($menu->parent == 0 && $menu->menu_type == 1){
//                $data.="<li class=\"nav-item \">";
//                $data.="<router-link class=\"nav-link\" to=\"$menu->url\">$menu->menu_name </router-link>";
//                $data.="</li>";
//            }elseif($menu->parent == 0 && $menu->menu_type == 2){
//                $data.="<li class=\"nav-item dropdown\">";
//                $data.="<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">$menu->menu_name</a>";
//
//                $data.="<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">";
//                foreach ($dropMenu as $drop)9{
//                    $data.="<router-link class=\"dropdown-item\" to=\"$drop->url\"> $drop->menu_name</router-link>";
//                }
//                $data.="</div>";
//                $data.="</li>";
//            }
//        }
//        $data.="</ul>";
        
        
        $data = DB::table('permissions')
            ->where('role',$this->guard()->user()->role)
            ->get();
        $output['checkPermission']  = collect($data)->groupBy('menu_name');
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
        if($this->checkPermission('menu', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        $obj = new Menu;
        $data = $obj::create([
            'menu_name'=>$request->menu_name,
            'type'=>$request->type,
            'status'=>$request->status,
            'icon'=>$request->icon,
            'parent'=>$request->parent,
            'menu_type'=>$request->menu_type,
            'url'=>$request->url,
            'slug'=>Str::slug($request->menu_name,'_'),
        ]);
        if($data){
            return response()->json(['message' => 'Menu Created Successfully ',$data,'code' => 2000]);
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
        if($this->checkPermission('menu', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        $obj = new Menu;
        $data = $obj::where('id',$id)->update([
            'menu_name'=>$request->menu_name,
            'type'=>$request->type,
            'status'=>$request->status,
            'icon'=>$request->icon,
            'parent'=>$request->parent,
            'menu_type'=>$request->menu_type,
            'url'=>$request->url,
            'slug'=>Str::slug($request->menu_name,'_'),
        ]);
        if($data){
            return response()->json(['message' => 'Menu Deleted Successfully ',$data,'code' => 2000]);
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
        if($this->checkPermission('menu', $this->route)){
            return response()->json(['message' => 'Nothing is here ,Please contact with support !','code' => 7000]);
        }
        $menu = Menu::destroy($id);
        if($menu){
            return response()->json(['message' => 'Menu Updated Successfully ','code' => 2000]);
        }else{
            return response()->json(['message' => 'Something went wrong','code' => 3000]);
        }
        
    }
    
    public function guard() {
        return \Auth::Guard('api');
    }
    
    
}
