<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentUser extends Model
{
    //
    protected $fillable = [
    	'document_id', 'user_id'
    ]
}
