<?php

namespace GovindTomar\Permission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolePermissionRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'route'  =>  'required',
			'role_id'  =>  'required',
			'permission_id'  =>  'required',
			'status'  =>  'required',
        ];
    }

}
