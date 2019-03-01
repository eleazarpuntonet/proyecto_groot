<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Databasket extends Model
{
    protected $table = '_databasket';

    public function tobasket()
    {
    	return $this->morphTo();
    }
}
