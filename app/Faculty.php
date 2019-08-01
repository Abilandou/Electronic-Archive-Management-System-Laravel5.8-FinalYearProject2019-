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
    	return $this->hasMany('App\Document');
    }

//    public function departments()
//    {
//    	return $this->hasMany(Department::class, 'faculty_id');
//    }
    public function faculties()
    {
        return $this->hasMany('App\Faculty', 'faculty_id');
    }
}
