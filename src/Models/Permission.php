<?php
namespace GovindTomar\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

	protected $table = 'permissions';
	
    protected $fillable = ['name','route',];

    

    
	public function role_permissions(){
		return $this->hasMany(RolePermission::class);
	}

}