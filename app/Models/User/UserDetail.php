<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = "user_detail";
    protected $fillable = ['id', 'user_id', 'created_at', 'updated_at'];

}
