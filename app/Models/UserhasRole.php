<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserhasRole extends Model
{
    use HasFactory;
    protected $table = 'user_has_role';

    protected $fillable = ['user_id', 'role_id'];
}
