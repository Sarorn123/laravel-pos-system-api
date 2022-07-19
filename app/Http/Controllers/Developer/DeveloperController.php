<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Permission\Permission;
use App\Models\Permission\RolePermission;
use App\Models\Role\Role;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public static function addRole(Request $request){
        $role = Role::create($request->all());
        if($role){
            return response([
                "data" => $role,
                "message" => "Added"
            ]);
        }
    }

    public static function addPermission(Request $request){
        $permission = Permission::create($request->all());
        if($permission){
            return response(["message" => "Added"]);
        }
    }

    public static function assignPermissionToRole(Request $request){

        $request->validate([
            "role_id" => "required",
            "permission_id" => "required",
        ]);

        $permission = RolePermission::create($request->all());
        if($permission){
            return response(["message" => "Added"]);
        }
    }


    
}
