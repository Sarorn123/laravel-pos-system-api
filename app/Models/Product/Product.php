<?php

namespace App\Models\Product;

use App\util\Util;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = "products";
    protected $guarded = ['id'];

    public static function getAllProducts($request)
    {
        $query = self::query();
        if ($request->search) {
            $query->where('name', 'LIKE', "%" . $request->search . "%");
        }
        return Util::pagination($request, $query);
    }

    public static function addProduct($request)
    {
        $in_stock_date = Util::dateCoverterToDB($request->in_stock_date);
        $request->merge(["in_stock_date" => $in_stock_date]);
        return self::create($request->all());
    }

    public static function updateProduct($request, $id)
    {
        $product = self::find($id);
        if ($request->in_stock_date) {
            $in_stock_date = Util::dateCoverterToDB($request->in_stock_date);
            $request->merge(["in_stock_date" => $in_stock_date]);
        }
        $product->update($request->all());
        return self::find($id);
    }
}
