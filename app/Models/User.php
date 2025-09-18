<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'contact_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getAllUsers()
    {
        return self::with('roles:id,name')
            ->select('id','uuid','name','email','contact_number')
            ->get();
    }

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'model_has_roles',
            'model_id',      
            'role_id'
        )->where('model_type', self::class);
    }

    public function scanned()
    {
        return $this->hasMany(Attendance::class, 'scanned_by');
    }
}
