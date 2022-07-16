<?php

namespace App\Models\Employee;

use App\Models\User;
use App\util\Util;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "employees";
    protected $guarded = ['id'];

    public static function getAllEmployee($request)
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

    public static function addEmployee($request)
    {
        $date_of_birth = Util::dateCoverterToDB($request->date_of_birth);
        $request->merge(["date_of_birth" => $date_of_birth]);
        return self::create($request->all());
    }

    public static function updateEmployee($request, $id)
    {
        $employee = self::find($id);
        $date_of_birth = Util::dateCoverterToDB($request->date_of_birth);
        $request->merge(["date_of_birth" => $date_of_birth]);
        ///// update User email //////
        User::where('id', $employee->user_id)->update(['email' => $request->email]);
        $employee->update($request->all());
        return self::find($id);
    }
}
