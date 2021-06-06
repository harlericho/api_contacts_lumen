<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = [
        'dni', 'names', 'address', 'phone', 'photo'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
