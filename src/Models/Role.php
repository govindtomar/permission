<?php
namespace GovindTomar\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

	use SoftDeletes;
	protected $table = 'roles';	
    protected $fillable = ['name','slug'];

	public function users(){
		return $this->hasMany(User::class);
	}

	public function role_permissions(){
		return $this->hasMany(RolePermission::class);
	}

}