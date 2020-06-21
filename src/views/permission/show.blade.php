@extends('layouts.admin.app')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Show Permission</h4>
                    <a href="{{ url('admin/permission') }}" class="btn btn-primary float-right">View All Permissions</a>
                </div>
                <div class="card-body">                        
                                            <div class="row pb-4">                           
                                                <div class="col-lg-3 text-right">Name : </div>
                                                <div class="col-lg-9">{{ $permission->name }}</div>
                                            </div> 
                                            <div class="row pb-4">                           
                                                <div class="col-lg-3 text-right">Route : </div>
                                                <div class="col-lg-9">{{ $permission->route }}</div>
                                            </div> 
                                    <ul style="display: inline-flex; float:right;">
                                        <li>
                                            <a href="{{ url('admin/permission/'. $permission->id.'/edit') }}" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        </li>
                                        <li>
                                            <form id="back-delete-form" action="{{ url('admin/permission', [$permission->id]) }}" method="POST">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </li>
                                    </ul>
                        		</div>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection