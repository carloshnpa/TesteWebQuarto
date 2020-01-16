<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'user_id','title','photo','description','value','street','number','postal_code','complement','city','state'
    ];

    protected $hidden = [

    ];
}
