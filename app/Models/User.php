<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use App\Scopes\UndeveloperUserScope;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password', 'status', 'avatar', 'phone',
        'address', 'birthday', 'gender', 'managers'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    public function scopeUndevelop($query){
        return $query->whereHas('roles', function($query){
            $query->where('name','!=', config('permission.role_dev'));
        });
    }

    public function isAdmin(){
        return $this->hasRole('admin');
    }

    public function findUser($id){
        $query = self::where('id', $id);
        if(!Auth::user()->hasRole(config('permission.role_dev'))){
            $query->undevelop();
        }

        return $query->first();
    }

    public function getAllUser(){
        $query = self::with('roles');
        if(!Auth::user()->hasRole(config('permission.role_dev'))){
            $query->undevelop();
        }
        
        return $query->get();
    }
}
