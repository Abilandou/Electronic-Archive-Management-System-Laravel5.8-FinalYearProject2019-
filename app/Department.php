<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //

	protected $fillable = [
		'name', 'faculty_id'
	];

    public function documents()
    {
    	return $this->hasMany('App\Document');
    }
    public function users()
    {
    	return $this->hasMany('App\User');
    }

    public function faculty()
    {
    	return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
