<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Role\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Permission\PermissionResource;
use App\Models\Employee\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\Permission\RolePermission;
use App\Models\User\UserDetail;
use App\Models\User\UserInfo;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
            "role_id" => "required",
        ]);
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        if(User::where('email' , $request->email)->first()){
            return response([
                "message" => "Email Already Exist !",
                "success" => false,
            ]);
        }

        $user = User::create($data);

        Employee::create(["user_id" => $user->id]);

        return response([
            "data" => "resgister successfully",
            "status" => "please login !",
            "success" => true,
        ]);
    }

    public function login(Request $request)
    {
        $loginData = (object) $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $loginData->email)->first();
        if (!$user || !Hash::check($loginData->password, $user->password)) {
            return response([
                'message' => "Invalid login !",
                'success' => false,
            ]);
        }
        if ($user) {

            $accessToken = $user->createToken('authToken')->plainTextToken;
            $employee = Employee::where('user_id', $user->id)->first();
            $role = Role::find($user->role_id);

            $data['user'] = $employee;
            $data['role'] = [
                "id" => $role ? $role->id : "",
                "name" =>$role ? $role->name : "",
            ];
            $data['permissions'] = PermissionResource::collection($role->getAllPermission);
            $data['token'] = $accessToken;
        }

        return response([
            "message" => "login_successfully",
            "status" => "OK",
            'success' => true,
            "data" => $data
        ], 200);
    }

    public function all_movies()
    {
        $response = Http::get("https://yts.torrentbay.to/api/v2/list_movies.json");
        return response(["data" => json_decode($response->body())]);
    }

    public static function getAllPermission($role_id){

        return  RolePermission::where('role_id', $role_id)->get();
    }
    public function getUserLoginByToken(){

        $user_logged_in = Auth::user();
        $user = User::find($user_logged_in->id);

        if ($user) {

            $accessToken = $user->createToken('authToken')->plainTextToken;
            $employee = Employee::where('user_id', $user->id)->first();
            $role = Role::find($user->role_id);

            $data['user'] = $employee;
            $data['role'] = [
                "id" => $role ? $role->id : "",
                "name" =>$role ? $role->name : "",
            ];
            $data['permissions'] = PermissionResource::collection($role->getAllPermission);
            $data['token'] = $accessToken;
        }else{

            return response([
                "message" => "User not found !",
                'success' => false,
            ], 200);

        }

        return response([
            "message" => "login_successfully",
            "status" => "OK",
            'success' => true,
            "data" => $data
        ], 200);
    }
}
