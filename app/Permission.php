<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
//class Permission extends Model
{
    //
    protected $table = 'permissions';
    public function roles(){
        return $this->belongsToMany(\Spatie\Permission\Models\Role::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
