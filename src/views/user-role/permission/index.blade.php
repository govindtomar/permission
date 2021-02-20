@extends(config('permission.layout'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permissions</h4>
                    <a href="{{ url($route.'permission/create') }}" class="btn btn-primary float-right"><i class="{{ config('permission.plus_icon') }}"></i> Add Permission</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Name</th>
									<th scope="col">Route</th>
									
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $table_counter = 1;
                                @endphp
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <th>{{ $table_counter }}</th>
                                        <td scope="col">{{ $permission->name }}</td>
										<td scope="col">{{ $permission->route }}</td>
										
                                        <td>
                                            <ul style="display: inline-flex;">
                                                <li>
                                                    <a href="{{ url($route.'permission/'. $permission->id) }}" class="btn btn-primary btn-sm"><i class="{{ config('permission.show_icon') }}"></i></a>
                                                </li>
                                                <li>
                                                    <a href="{{ url($route.'permission/'. $permission->id.'/edit') }}" class="btn btn-success btn-sm"><i class="{{ config('permission.edit_icon') }}" aria-hidden="true"></i></a>
                                                </li>
                                                <li>
                                                    <form id="back-delete-form" action="{{ url($route.'permission', [$permission->id]) }}" method="POST">
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
                            {{ $permissions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
