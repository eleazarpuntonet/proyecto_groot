<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tableauthrole extends Model
{
   	protected $table      = 'path_items';
   	public $timestamps    = false;	
   	protected $primaryKey = 'pathitem_id';
   	protected $casts = ['pathitem_id' => 'string'];


    public function path_auth()
    {
    	// return $this->belongsToMany(Role::class,'pathitems_roles','role_id','pathitem_id');
    	return $this->belongsToMany(Role::class,'pathitems_roles','pathitem_id','role_id');
    }


}
