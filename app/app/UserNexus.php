<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNexus extends Model
{
    protected $table = 'user_nexus';

    public function company()
    {
        return $this->hasOne('App\Company', 'id', 'user_id');
    }

    public function user(){
        return $this->hasOne('App\User', 'id', 'operator_id');
    }
}
