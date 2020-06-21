@extends('layouts.admin.app')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Role</h4>
                    <a href="{{ url('admin/role') }}" class="btn btn-primary float-right">View All Roles</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('admin/role') }}">
                        <div class="row">
                            @csrf
                            @method('PUT')
							<input id="id" type="hidden" class="form-control" name="id" value="{{ $role->id }}" >
							<div class="col-lg-6">
								<div class="form-group">
								    <label for="name" class="col-form-label">{{ __('Name') }}</label>
							        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}">
							        @error('name')
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $message }}</strong>
		                                </span>
		                            @enderror
							    </div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
								    <label for="url" class="col-form-label">{{ __('Url') }}</label>
							        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ $role->url }}">
							        @error('url')
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $message }}</strong>
		                                </span>
		                            @enderror
							    </div>
							</div>
                    	</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">                                
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Role') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection