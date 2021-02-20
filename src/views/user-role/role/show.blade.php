@extends(config('permission.layout'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Show Role</h4>
                    <a href="{{ url($route.'role') }}" class="btn btn-primary float-right">View All Roles</a>
                </div>
                <div class="card-body">                        
                    <div class="row pb-4">                           
                        <div class="col-lg-3 text-right">Name : </div>
                        <div class="col-lg-9">{{ $role->name }}</div>
                    </div> 
                    <div class="row pb-4">                           
                        <div class="col-lg-3 text-right">Slug : </div>
                        <div class="col-lg-9">{{ $role->slug }}</div>
                    </div> 
                    <ul style="display: inline-flex; float:right;">
                        <li>
                            <a href="{{ url($route.'role/'. $role->id.'/edit') }}" class="btn btn-success btn-sm"><i class="{{ config('permission.edit_icon') }}" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <form id="back-delete-form" action="{{ url($route.'role', [$role->id]) }}" method="POST">
                                @csrf
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger btn-sm"><i class="{{ config('permission.delete_icon') }}"></i></button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection