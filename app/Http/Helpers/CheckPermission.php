<?php

namespace App\Http\Helpers;

use App\Models\Permission;

trait CheckPermission{
    /**
     * @param $name
     * @param $url
     * @param $method
     * @return bool
     */
    public  function checkPermission($name, $url ){
        $route = explode(".",$url);
        $check = Permission::where('menu_name',$name)->first();
    
        if($route[1] == 'index' && $check->show == 0){
            return true;
        }elseif ($route[1] == 'insert' && $check->insert == 0){
            return true;
        }elseif ($route[1] == 'create' && $check->create == 0){
            return true;
        }elseif ($route[1] == 'edit' && $check->edit == 0){
            return true;
        }elseif ($route[1] == 'update' && $check->update == 0){
            return true;
        }elseif ($route[1] == 'destroy' && $check->delete == 0){
            return true;
        }elseif ($route[1] == 'show' && $check->view == 0){
            return true;
        }else{
            return false;
        }
        
    }
}


?>