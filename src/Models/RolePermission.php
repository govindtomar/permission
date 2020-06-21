<?php
namespace GovindTomar\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{

	protected $table = 'role_permissions';
	
    protected $fillable = ['route','role_id','permission_id','status',];

    public function role(){
		return $this->belongsTo(Role::class);
	}

	public function permission(){
		return $this->belongsTo(Permission::class);
	}

    
}