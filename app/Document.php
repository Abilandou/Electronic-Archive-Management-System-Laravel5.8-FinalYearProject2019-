<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $fillable = [
    	'name', 'description', 'expires_at', 'file',
    	'user_id', 'category_id', 'faculty_id',
    	'department_id', 'mimetype', 'filesize'
    ];

    public function department()
    {
    	return $this->belongsTo('App\Department');
    }

    public function faculty()
    {
    	return $this->belongsTo('App\Faculty');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

}
