<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $Employee = Employee::getAllEmployee($request);
        return response([
            "data" => EmployeeResource::collection($Employee),
            'total_result' => $Employee->count(),
            'perPage' => intval($request->perPage) ?: 10,
            'page_number' => intval($request->page_number) ?: 1,
            'page_count' => ceil(Employee::all()->count() / ($request->perPage ? intval($request->perPage) : 10)),
            "message" => "Query Success",
            "success" => true,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "gender" => "required|numeric",
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'date_of_birth' => 'required|date_format:d-m-Y',
            'salary' => 'required|numeric',
            'address' => 'required',
            'position_id' => 'required',
            'role_id' => 'required',
        ]);

        if(User::where('email', $request->email)->first()){
            return response([
                "message" => "Email Already Exist !",
                "success" => false,
            ]);
        }
        $user_data = [
            'email' => $request->email, 
            'password' => Hash::make('12345'), 
            'role_id' => $request->role_id
        ];

        $user = User::create($user_data);
        $request->merge(['user_id' => $user->id]);

        $Employee = Employee::addEmployee($request);
        return response([
            "data" => new EmployeeResource($Employee),
            "message" => "Add Success",
            "success" => true,
        ]);
    }
    public function show($id)
    {

        $Employee = Employee::find($id);
        if ($Employee) {
            return response([
                "data" => new EmployeeResource($Employee),
                "message" => "Query Success",
                "success" => true,
            ]);
        }
        return response([
            "data" => null,
            "message" => "No Data !",
            "success" => false,
        ]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            "name" => "required",
            "gender" => "required|numeric",
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'date_of_birth' => 'required|date_format:d-m-Y',
            'salary' => 'required|numeric',
            'address' => 'required',
            'position_id' => 'required',
        ]);

        $employee = Employee::find($id);

        if (!$employee) {
            return response([
                "success" => false,
                "message" => "Not Found Employee!"
            ]);
        }
        if(User::where('email', $request->email)->where('id', '!=', $employee->user_id)->first()){
            return response([
                "message" => "Email Already Exist !",
                "success" => false,
            ]);
        }

        $Employee = Employee::updateEmployee($request, $id);

        return response([
            "data" => new EmployeeResource($Employee),
            "message" => "Query Success",
            "success" => true,
        ]);
    }

    public function destroy($id)
    {

        $Employee = Employee::find($id);

        if (!$Employee) {
            return response([
                "message" => "Not Found Employee !",
                "success" => false,
            ]);
        }

        User::where('id', $Employee->user_id)->delete();
        $Employee->delete();


        return response([
            "message" => "Delete Success",
            "success" => true,
        ]);
    }
}
