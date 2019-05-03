<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
	protected $table = 'action_permisions';
	
	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id','id');
	}

	public function actions()
	{
		return $this->belongsTo(ActionsAuth::class, 'action_id','action_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'role_id','id');
	}
}
