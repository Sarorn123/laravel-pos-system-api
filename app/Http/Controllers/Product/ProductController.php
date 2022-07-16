<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $product = Product::getAllProducts($request);
        return response([
            "data" => ProductResource::collection($product),
            'total_result' => $product->count(),
            'perPage' => intval($request->perPage) ?: 10,
            'page_number' => intval($request->page_number) ?: 1,
            'page_count' => ceil(Product::all()->count() / ($request->perPage ? intval($request->perPage) : 10)),
            "message" => "Query Success",
            "success" => true,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "category_id" => "required",
            "in_stock_price" => "required",
            "sell_price" => "required",
            "in_stock" => "required",
            "discount" => "required",
            "supplier_id" => "required",
            "in_stock_date" => "required | date_format:d-m-Y",
        ]);

        $product = Product::addProduct($request);
        return response([
            "data" => new ProductResource($product),
            "message" => "Add Success",
            "success" => true,
        ]);
    }
    public function show($id)
    {

        $product = Product::find($id);
        if ($product) {
            return response([
                "data" => new ProductResource($product),
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

        if ($request->in_stock_date) {
            $request->validate([
                "in_stock_date" => "required | date_format:d-m-Y",
            ]);
        }

        if (!Product::find($id)) {
            return response([
                "success" => false,
                "message" => "Not Found Product!"
            ]);
        }

        $product = Product::updateProduct($request, $id);

        return response([
            "data" => new ProductResource($product),
            "message" => "Query Success",
            "success" => true,
        ]);
    }

    public function destroy($id)
    {

        $product = Product::find($id);

        if (!$product) {
            return response([
                "message" => "Not Found Product !",
                "success" => false,
            ]);
        }

        $product->delete();

        return response([
            "message" => "Delete Success",
            "success" => true,
        ]);
    }
}
