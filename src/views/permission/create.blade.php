@extends('layouts.admin.app')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Permission</h4>
                    <a href="{{ url('admin/permission') }}" class="btn btn-primary float-right">View All Permissions</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('admin/permission') }}">
                        <div class="row">
                            @csrf

							<div class="col-lg-6">
                                <div class="form-group">
							        <label for="name" class="col-form-label">{{ __('Name') }}</label>
							        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >
							        @error('name')
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $message }}</strong>
		                                </span>
		                            @enderror
							    </div>
							</div>
							<div class="col-lg-6">
                                <div class="form-group">
							        <label for="route" class="col-form-label">{{ __('Route') }}</label>
							        <input id="route" type="text" class="form-control @error('route') is-invalid @enderror" name="route" value="{{ old('route') }}" >
							        @error('route')
		                                <span class="invalid-feedback" role="alert">
		                                    <strong>{{ $message }}</strong>
		                                </span>
		                            @enderror
							    </div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create Permission') }}
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
