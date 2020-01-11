<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'user_id','title','photo','description','value','street','number','postal_code','complement','city','state'
    ];
}
