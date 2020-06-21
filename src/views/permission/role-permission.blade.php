@extends('layouts.admin.app')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <form method="POST" action="{{ url('admin/role-permission/'.$role->url) }}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <label class="checkbox-inline mr-3 pl-4 mb-0">
                                <input type="checkbox" checked  data-toggle="toggle" class="mr-2 btn-sm" data-onstyle="success" data-offstyle="danger" data-size="sm"> Check All
                            </label>
                        </h5>
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-file-o" aria-hidden="true"></i> Save Permission</button>
                    </div>                
                </div>
                @foreach($permissions as $permission)
                <div class="card" id="{{ $role->url.'-'.$permission->route }}">
                    <div class="card-header" style="margin-bottom: 0;">
                        <h5 class="card-title">{{ $permission->name }}</h5>
                        <button type="button"  class="btn btn-info float-right btn-xs" data-toggle="modal" data-target="#addNewPermission" onclick="setDataOnPopUp('{{ $role->url }}', '{{ $permission->route }}')"><i class="bx bx-plus"></i></button>
                    </div>
                    <div class="card-body" style="margin-top: 0;">
                        <ul class="nav">
                            @foreach($permission->role_permissions as $role_perm)
                                <li class="nav-item mr-5">
                                    <label class="checkbox-inline nav-link pl-4 mr-3 mb-0">
                                        <input type="checkbox" @if($role_perm->status == 1) checked @endif data-toggle="toggle" class="mr-2 btn-sm permission-toggle-btn" data-onstyle="success" data-offstyle="danger" name="permission[{{ $role_perm->route }}]" data-size="xs"> {{ $role_perm->display_name }}
                                    </label>
                                </li>                            
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <label class="checkbox-inline mr-3 pl-4 mb-0">
                                <input type="checkbox" checked  data-toggle="toggle" class="mr-2 btn-sm" data-onstyle="success" data-offstyle="danger" data-size="sm"> Check All
                            </label>
                        </h4>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-file-o" aria-hidden="true"></i> Save Permission</button>
                    </div>                
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewPermission" tabindex="-1" role="dialog" aria-labelledby="addNewPermissionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewPermissionLabel">Add New Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('admin/user') }}" method="POST" onsubmit="updateRouteForm(event)">
            <div class="modal-body">                
                <div class="form-group">
                    <label for="recipient-name" style="display: block;" class="col-form-label">Select Your Route Type</label>
                    <div class="form-check">
                        <input class="form-check-input route_type_change" onchange="route_type_change('create-update')" type="radio" name="route_type" id="route_type1" value="create-update" checked>
                        <label class="form-check-label" for="route_type1">
                            Create / Update Route
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input route_type_change"  onchange="route_type_change('view-delete')" type="radio" name="route_type" id="route_type2" value="view-delete">
                        <label class="form-check-label" for="route_type2">
                            View / Delete Route
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="routeViewDelete" class="col-form-label">Display Name</label>
                    <input type="text" class="form-control" name="" id="routeNameViewDelete" placeholder="ex - Update Profile / Change Status">
                    <input type="hidden" class="form-control" name="" id="appendPermission" value="">
                    <input type="hidden" class="form-control" name="" id="jsRoleRoute" value="">                    
                </div>
                <div class="form-group">
                    <label for="routeViewDelete" class="col-form-label">Route Name / Not Url</label>                         
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="appendViewDelete">route</span>
                        </div>
                        <input type="text" class="form-control" name="route_view_delete" id="routeViewDelete" placeholder="ex - profile" required>
                    </div>
                </div>
                <div class="form-group" id="routeNameCreateUpdateBlock">
                    <label for="routeCreateUpdate" class="col-form-label">Route Name / Not Url</label>                           
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="appendCreateUpdate">route</span>
                        </div>
                        <input type="text" class="form-control" name="route_create_update" id="routeCreateUpdate" placeholder="ex - profile.save">
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Send message</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var site_name = '{{ url('/') }}';
    var token = '{{ csrf_token() }}';
    function route_type_change(route_type){
        if (route_type == 'view-delete') {
            document.getElementById('routeNameCreateUpdateBlock').style.display = "none";
        }else if(route_type == 'create-update'){
            document.getElementById('routeNameCreateUpdateBlock').style.display = "block";
        }
    }

    function setDataOnPopUp(role, permission){
        document.getElementById('appendViewDelete').innerHTML = role+'.'+permission+'.';
        document.getElementById('appendCreateUpdate').innerHTML = role+'.'+permission+'.';
        document.getElementById('appendPermission').value = permission;
        document.getElementById('jsRoleRoute').value = role+'-'+permission;

    }
    function updateRouteForm(event){
        event.preventDefault();
        var radio = document.getElementById("route_type2").checked;

        var viewDelete = document.getElementById('routeViewDelete').value;
        var viewDeleteName = document.getElementById('routeNameViewDelete').value;
        var viewPermission = document.getElementById('appendPermission').value;
        if (radio == false) {
            var createUpdate = document.getElementById('routeCreateUpdate').value;
        }else{
            var createUpdate = null;
            var createUpdateName = null;
        }

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                response = JSON.parse(this.responseText);

                // html  = '<li class="nav-item mr-5">'
                // html +=    '<label class="checkbox-inline nav-link pl-4 mr-3 mb-0">'
                // html +=        '<div class="toggle btn btn-danger off btn-xs" data-toggle="toggle" role="button" style="width: 41.5px; height: 19px;"><input type="checkbox" data-toggle="toggle" class="mr-2 btn-sm permission-toggle-btn" data-onstyle="success" data-offstyle="danger" name="permission['+response.route+']" data-size="xs"><div class="toggle-group"><label for="" class="btn btn-success btn-xs toggle-on">On</label><label for="" class="btn btn-danger btn-xs toggle-off">Off</label><span class="toggle-handle btn btn-light btn-xs"></span></div>'
                // html +=        '</div>'+response.display_name
                // html +=    '</label>'
                // html += '</li>'


                // html  = '<li class="nav-item mr-5">';
                // html +=    '<label class="checkbox-inline nav-link pl-4 mr-3 mb-0">'
                // html +=        '<input type="checkbox" data-toggle="toggle" class="mr-2 btn-sm" data-onstyle="success" data-offstyle="danger" name="permission[new.route]" data-size="xs"> route name';
                // html +=    '</label>';
                // html += '</li>';

                // id = document.getElementById('jsRoleRoute').value
                // parent = document.querySelector('#'+id+' ul');
                // parent.innerHTML += html;

                // if (jQuery.type(undefined) != undefined) {
                //     jQuery('.permission-toggle-btn').bootstrapToggle();
                //     console.log('console');
                // }
                
                window.location.reload();


            }
        };

        var parm =  "_token="+token;
        parm    +=  "&view_delete="+viewDelete;
        parm    +=  "&view_delete_name="+viewDeleteName;
        parm    +=  "&create_update="+createUpdate;
        parm    +=  '&select='+radio;
        parm    +=  '&permission='+viewPermission;

        xhttp.open("POST", site_name+"/admin/role-permission/add-new", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(parm);
    }
</script>
@endsection
