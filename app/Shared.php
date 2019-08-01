<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shared extends Model
{
    //
    protected $fillable = [
    	'name', 'description', 'expires_at', 'file',
    	'user_id', 'category_id', 'faculty_id',
    	'department_id', 'mimetype', 'filesize'
    ];

    public function documents()
    {
    	return $this->hasMany('App/Document');
    }


}