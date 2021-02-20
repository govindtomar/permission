@extends(config('permission.layout'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Create New Permission</h4>
                    <a href="{{ url($route.'permission') }}" class="btn btn-link float-right">View All Permissions</a>
                </div>
                <hr>
                <div class="card-body">
                    <form method="POST" action="{{ url($route.'permission') }}" id="permission-form-submit">
                        @csrf						
                        <div class="form-group row">
					        <label for="name" class="col-form-label col-md-4">{{ __('Name') }}</label>
                            <div class="col-md-8">
					            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="ex - admin permission for crud operation">
						        @error('name')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>                                
	                            @enderror
                            </div>
                        </div>							
                        <div class="form-group row">
					        <label for="route" class="col-form-label col-md-4">{{ __('Route') }}</label>
                            <div class="col-md-8">
						        <input id="route" type="text" class="form-control @error('route') is-invalid @enderror" name="route" value="{{ old('route') }}" placeholder="ex - admin">
						        @error('route')
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
                            </div>
						</div>
					</form>
                </div>
            </div>
	    </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary float-right" form="permission-form-submit">
                        <i class="{{ config('permission.save_icon') }}"></i>
                        {{ __('Save Permission') }}
                    </button>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
