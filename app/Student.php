<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //

    protected $fillable = [
    	'name', 'matricle', 'file', 'faculty_id',
    	'department_id', 'mimetype'
    ];

    public function faculty()
    {
    	return $this->belongsTo('App\Faculty');
    }

    public function department()
    {
    	return $this->belongsTo('App\Department');
    }
}
