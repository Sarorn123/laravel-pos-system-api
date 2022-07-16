<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {

        $customer = Customer::getAllCustomer($request);
        return response([
            "data" => CustomerResource::collection($customer),
            'total_result' => $customer->count(),
            'perPage' => intval($request->perPage) ?: 10,
            'page_number' => intval($request->page_number) ?: 1,
            'page_count' => ceil(Customer::all()->count() / ($request->perPage ? intval($request->perPage) : 10)),
            "message" => "Query Success",
            "success" => true,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "gender" => "required|numeric",
            'phone' => 'required|numeric'
        ]);

        $Customer = Customer::addCustomer($request);
        return response([
            "data" => new CustomerResource($Customer),
            "message" => "Add Success",
            "success" => true,
        ]);
    }
    public function show($id)
    {

        $customer = Customer::find($id);
        if ($customer) {
            return response([
                "data" => new CustomerResource($customer),
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
            'phone' => 'required|numeric'
        ]);

        if (!Customer::find($id)) {
            return response([
                "success" => false,
                "message" => "Not Found Customer!"
            ]);
        }

        $Customer = Customer::updateCustomer($request, $id);

        return response([
            "data" => new CustomerResource($Customer),
            "message" => "Query Success",
            "success" => true,
        ]);
    }

    public function destroy($id)
    {

        $customer = Customer::find($id);

        if (!$customer) {
            return response([
                "message" => "Not Found Customer !",
                "success" => false,
            ]);
        }

        $customer->delete();

        return response([
            "message" => "Delete Success",
            "success" => true,
        ]);
    }
}
