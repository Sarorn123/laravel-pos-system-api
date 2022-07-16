<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Transaction\TransactionResource;
use App\Models\Customer\Customer;
use App\Models\Employee\Employee;
use App\Models\Product\Product;
use App\Models\Transaction\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transaction = Transaction::getAllTransactions($request);
        return response([
            "data" => TransactionResource::collection($transaction),
            'total_result' => $transaction->count(),
            'perPage' => intval($request->perPage) ?: 10,
            'page_number' => intval($request->page_number) ?: 1,
            'page_count' => ceil(Transaction::all()->count() / ($request->perPage ? intval($request->perPage) : 10)),
            "message" => "Query Success",
            "success" => true,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "product_id" => "required",
            "customer_id" => "required",
            "quantity" => "required",
            "transaction_number" => "required",
            'date' => 'required|date_format:d-m-Y',
        ]);

        $product = Product::find($request->product_id);

        if(!$product){
            return response([
                "message" => "Product Not Found !",
                "success" => false,
            ]);
        }
        if(!Customer::find($request->customer_id)){
            return response([
                "message" => "Customer Not Found !",
                "success" => false,
            ]);
        }

        if(Transaction::where('transaction_number', $request->transaction_number)->first()){
            return response([
                "message" => "Transaction number already exist !",
                "success" => false,
            ]);
        }
        
        if($request->quantity > $product->in_stock){
            return response([
                "message" => "Product is only have  ". $product->in_stock,
                "success" => false,
            ]);
        }

        $transaction = Transaction::addTransaction($request);
        return response([
            "data" => new TransactionResource($transaction),
            "message" => "Add Success",
            "success" => true,
        ]);
    }
    public function show($id)
    {

        $transaction = Transaction::find($id);
        if ($transaction) {
            return response([
                "data" => new TransactionResource($transaction),
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
            "product_id" => "required",
            "customer_id" => "required",
            "quantity" => "required",
            "transaction_number" => "required",
            'date' => 'required|date_format:d-m-Y',
        ]);

        $transaction = Transaction::find($id);
        $product = Product::find($request->product_id);

        if (!$transaction) {
            return response([
                "success" => false,
                "message" => "Transaction Not Found !"
            ]);
        }

        if (!Customer::find($request->customer_id)) {
            return response([
                "success" => false,
                "message" => "Customer Not Found !"
            ]);
        }
        if (!$product) {
            return response([
                "success" => false,
                "message" => "Product Not Found !"
            ]);
        }

        if($request->quantity > $product->in_stock + $transaction->quantity){
            return $product->in_stock + $transaction->quantity;
            return response([
                "message" => "Product is only have  ". $product->in_stock + $transaction->quantity,
                "success" => false,
            ]);
        }

        if(Transaction::where('transaction_number', $request->transaction_number)->where('id' ,'!=', $id)->first()){
            return response([
                "message" => "Transaction number already exist !",
                "success" => false,
            ]);
        }

        $transaction = Transaction::updateTransaction($request, $id);

        return response([
            "data" => new TransactionResource($transaction),
            "message" => "Update Success",
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
