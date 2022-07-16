<?php

namespace App\Models\Role;

use App\Models\Permission\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model{

    use HasFactory;

    protected $primaryKey = "id";
    protected $table = "roles";
    protected $guarded = ['id'];

    public function getAllPermission(){
        return $this->belongsToMany( Permission::class , 'role_permission', 'role_id', 'permission_id');
    }


}