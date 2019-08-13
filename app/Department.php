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
    	return $this->hasMany(Document::class);
    }
    public function users()
    {
    	return $this->hasMany(User::class);
    }

    public function faculty()
    {
    	return $this->belongsTo(Faculty::class);
    }
}
