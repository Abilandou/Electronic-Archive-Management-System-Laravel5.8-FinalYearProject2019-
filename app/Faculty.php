<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    //
    protected $fillable = [
    	'name',
    ];

    public function documents()
    {
    	return $this->hasMany(Document::class);
    }

    public function departments()
    {
    	return $this->hasMany(Department::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

}
