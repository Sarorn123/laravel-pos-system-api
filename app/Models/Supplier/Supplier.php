<?php

namespace App\Models\Supplier;

use App\util\Util;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "suppliers";
    protected $guarded = ['id'];

    public static function getAllSuppliers($request)
    {
        $query = self::query();
        if ($request->search) {
            $query->where('name', 'LIKE', "%" . $request->search . "%");
        }
        return Util::pagination($request, $query);
    }

    public static function addSupplier($request)
    {
        return self::create($request->all());
    }

    public static function updateSupplier($request, $id)
    {
        $supplier = self::find($id);
        $supplier->update($request->all());
        return self::find($id);
    }
}
