<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_has_role', 'user_id', 'role_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    // Kiểm tra user có phải là admin không
    public function isAdmin()
    {
        return $this->roles()->whereIn('name', ['Editer', 'Viewer'])->exists();
    }

    // Kiểm tra user có role admin_full_access không
    public function isFullAccessAdmin()
    {
        return $this->roles()->where('name', 'Editer')->exists();
    }

    // Kiểm tra user có role admin_read_only không
    public function isReadOnlyAdmin()
    {
        return $this->roles()->where('name', 'Viewer')->exists();
    }
}
