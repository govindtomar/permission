<?php
namespace GovindTomar\Permission\Helper;

class Helper
{
	public static function route(){
		return config('permission.route_prefix') ? config('permission.route_prefix').'/' : '';
	}

    public static function routeName(){
		return config('permission.route_prefix') ? config('permission.route_prefix').'.' : '';
	}
}
