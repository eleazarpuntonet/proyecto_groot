<?php

namespace App;
// use App\Tableuathrole;
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


	public function path()
    {
    	return $this->belongsTo(Tableauthrole::class, 'pathitem_id', 'path_id');
    }

    public function permisos()
    {
        return $this->hasMany(Permisos::class, 'action_id', 'action_id');
    }
}
