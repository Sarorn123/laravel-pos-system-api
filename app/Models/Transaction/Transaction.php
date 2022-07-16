<?php

namespace App\Models\Transaction;

use App\Models\Customer\Customer;
use App\Models\Product\Product;
use App\Models\User;
use App\util\Util;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "transactions";
    protected $guarded = ['id'];

    public function getProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public static function getAllTransactions($request)
    {
        $query = self::query();
        return Util::pagination($request, $query);
    }

    public static function addTransaction($request)
    {
        $product = Product::find($request->product_id);
        $discount = $product->discount;
        $product_price = $product->sell_price;
        $total_price = $product_price - ($product_price * $discount / 100);
        $price = $total_price * $request->quantity;
        $date = Util::dateCoverterToDB($request->date);
        // update stock product 
        $product->update(['in_stock' => $product->in_stock - $request->quantity]);
        $request->merge(["date" => $date, 'price' => $price, 'discount' => $discount]);
        return self::create($request->all());
    }

    public static function updateTransaction($request, $id)
    {
        $tran = self::find($id);

        $product = Product::find($request->product_id);
        $discount = $product->discount;
        $product_price = $product->sell_price;
        $total_price = $product_price - ($product_price * $discount / 100);
        $price = $total_price * $request->quantity;
        $date = Util::dateCoverterToDB($request->date);
        // update stock product 
        $product->update(['in_stock' => $product->in_stock + $tran-> quantity - $request->quantity]);
        $request->merge(["date" => $date, 'price' => $price]);
        $tran->update($request->all());
        return self::find($id);
    }
}
