<?php

namespace App\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class UndevelopRoleScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(Auth::check() && !Auth::user()->hasRole(config('permission.role_dev'))){
            $builder->where('name', '!=', config('permission.role_dev'));
        }
    }
}