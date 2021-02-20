<?php
namespace GovindTomar\Permission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{

	use SoftDeletes;
	protected $table = 'permissions';	
    protected $fillable = ['name','route',];

	public function role_permissions(){
		return $this->hasMany(RolePermission::class);
	}

}