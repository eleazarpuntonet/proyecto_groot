<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionsAuth extends Model
{
	protected $table       = 'auth_actions';
	public $timestamps     = false;	
	protected $primaryKey  = 'action_id';
	protected $casts       = ['action_id' => 'string'];

	public function action_auth()
    {
    	// return $this->belongsToMany(Role::class,'pathitems_roles','role_id','pathitem_id');
    	return $this->belongsToMany(Role::class,'authactions_roles','action_id','role_id');
    }
}
