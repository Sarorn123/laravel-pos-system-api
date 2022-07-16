<?php

namespace App\Models\Customer;

use App\util\Util;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = "customers";
    protected $guarded = ['id'];

    public static function getAllCustomer($request)
    {
        $query = self::query();
        if ($request->search) {
            $query->where('name', 'LIKE', "%" . $request->search . "%")
            ->orWhere('email', 'LIKE', "%" . $request->search . "%" )
            ->orWhere('phone', 'LIKE', "%" . $request->search . "%" );
        }
        if($request->gender){
            $query->where('gender', $request->gender);
        }
        return Util::pagination($request, $query);
    }

    public static function addCustomer($request)
    {
        return self::create($request->all());
    }

    public static function updateCustomer($request, $id)
    {
        $customer = self::find($id);
        $customer->update($request->all());
        return self::find($id);
    }
}
