@extends(config('permission.layout'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles</h4>
                    <div class="float-right">
                        <a href="{{ url($route.'permission/create') }}" class="btn btn-primary"><i class="{{ config('permission.plus_icon') }}"></i> Add Permission</a>
                        <a href="{{ url($route.'role/create') }}" class="btn btn-primary"><i class="{{ config('permission.plus_icon') }}"></i> Add Role</a>
                    </div>

                </div>
                <hr>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Name</th>
									<th scope="col">slug</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $table_counter = 1;
                                @endphp
                                @foreach ($roles as $role)
                                    <tr>
                                        <th>{{ $table_counter }}</th>
                                        <td scope="col">{{ $role->name }}</td>
										<td scope="col">{{ $role->slug }}</td>

                                        <td>
                                            <ul style="display: inline-flex;">
                                                <li>
                                                    <a href="{{ url($route.'role/permission/'. $role->slug) }}" class="btn btn-info btn-sm"><i class="{{ config('permission.lock_icon') }}"></i></a>
                                                </li>
                                                {{-- <li>
                                                    <a href="{{ slug($route.'role/'. $role->id) }}" class="btn btn-primary btn-sm"><i class="{{ config('permission.show_icon') }}"></i></a>
                                                </li> --}}
                                                <li>
                                                    <a href="{{ url($route.'role/'. $role->id.'/edit') }}" class="btn btn-success btn-sm"><i class="{{ config('permission.edit_icon') }}"></i></a>
                                                </li>
                                                <li>
                                                    <form id="back-delete-form" action="{{ url($route.'role', [$role->id]) }}" method="POST">
                                                      @csrf
                                                      {{method_field('DELETE')}}
                                                      <button type="submit" class="btn btn-danger btn-sm"><i class="{{ config('permission.delete_icon') }}"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                        @php
                                            $table_counter = $table_counter + 1 ;
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="index-pagination">
                            {{ $roles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
