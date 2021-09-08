<?php

namespace App\Models;

use App\Scopes\UndevelopRoleScope;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    protected static function booted(){
        static::addGlobalScope(new UndevelopRoleScope);
    }
}
