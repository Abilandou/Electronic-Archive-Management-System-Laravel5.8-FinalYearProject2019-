<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App
 */
//class Role extends \Spatie\Permission\Models\Role
class Role extends Model
{
    //
    protected $table = 'roles';

//    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
//    {
//        return parent::permissions();
//    }

    public function permissions(){
        return $this->belongsToMany(\Spatie\Permission\Models\Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
