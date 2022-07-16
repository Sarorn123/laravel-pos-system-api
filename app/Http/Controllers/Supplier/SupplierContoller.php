<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Resources\Supplier\SupplierResource;
use App\Models\Supplier\Supplier;
use Illuminate\Http\Request;

class SupplierContoller extends Controller
{
    
    public function index(Request $request)
    {
        $supplier = Supplier::getAllSuppliers($request);
        return response([
            "data" => SupplierResource::collection($supplier),
            'total_result' => $supplier->count(),
            'perPage' => intval($request->perPage) ?: 10,
            'page_number' => intval($request->page_number) ?: 1,
            'page_count' => ceil(Supplier::all()->count() / ($request->perPage ? intval($request->perPage) : 10)),
            "message" => "Query Success",
            "success" => true,
        ]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "phone" => "required",
            "address" => "required",
        ]);

        $supplier = Supplier::addSupplier($request);
        return response([
            "data" => new SupplierResource($supplier),
            "message" => "Add Success",
            "success" => true,
        ]);
    }

   
    public function show($id)
    {
        $supplier = Supplier::find($id);
        if(!$supplier){
            return response([
                "message" => "Supplier Not Found !",
                "success" => false,
            ]);
        }
        return response([
            "data" => new SupplierResource($supplier),
            "message" => "Add Success",
            "success" => true,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "phone" => "required",
            "address" => "required",
        ]);

        $supplier = Supplier::find($id);
        if(!$supplier){
            return response([
                "message" => "Supplier Not Found !",
                "success" => false,
            ]);
        }

        $supplier = Supplier::updateSupplier($request, $id);
        return response([
            "data" => new SupplierResource($supplier),
            "message" => "Add Success",
            "success" => true,
        ]);
    }

   
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        if(!$supplier){
            return response([
                "message" => "Supplier Not Found !",
                "success" => false,
            ]);
        }
        $supplier->delete();
        
        return response([
            "message" => "Add Success",
            "success" => true,
        ]);
    }
}
