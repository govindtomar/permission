<?php
namespace GovindTomar\Permission\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

	protected $table = 'roles';
	
    protected $fillable = ['name','url',];

    

    
	public function users(){
		return $this->hasMany(User::class);
	}

	public function role_permissions(){
		return $this->hasMany(RolePermission::class);
	}

}