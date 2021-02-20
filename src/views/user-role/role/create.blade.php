@extends(config('permission.layout'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Role</h4>
                    <a href="{{ url($route.'role') }}" class="btn btn-link float-right">View All Roles</a>
                </div>
                <hr>
                <form method="POST" action="{{ url($route.'role') }}" id="role-form-submit">
                    @csrf
                    <div class="card-body">                                
                        <div class="form-group row">
					        <label for="name" class="col-form-label col-md-4">{{ __('Name') }}</label>
					        <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="ex - Admin">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
					    </div>
                        <div class="form-group row">
					        <label for="slug" class="col-form-label col-md-4">{{ __('Slug') }}</label>
					        <div class="col-md-8">
                                <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" placeholder="ex - admin">
                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror                     
                            </div>
					    </div>
                    </div>
                </div>
			</form>
	    </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">                                
                    {{-- <div class="form-group clearfix"> --}}
                        <button type="submit" class="btn btn-primary float-right" form="role-form-submit">
                            <i class="{{ config('permission.save_icon') }}"></i>
                            {{ __('Save Role') }}
                        </button>
                    {{-- </div> --}}
                   {{--  <div class="form-group clearfix mt-5">
                        <label for="slug" class="col-form-label">{{ __('Roll wants permission') }}</label>
                        <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" placeholder="ex - admin">
                        @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
