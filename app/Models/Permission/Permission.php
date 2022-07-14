<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model{

    use HasFactory;

    protected $primaryKey = "id";
    protected $table = "permissions";
    protected $fillable = ['name', "url"];

    public static function getAllChildrenbyParentId($parent_id){
        return Permission::where('parent_id', $parent_id)->get();
    }

}