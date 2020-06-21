@extends('layouts.admin.app')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles</h4>
                    <a href="{{ url('admin/role/create') }}" class="btn btn-primary float-right">+ Add Role</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th scope="col">Name</th>
									<th scope="col">Url</th>
									
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
										<td scope="col">{{ $role->url }}</td>
										
                                        <td>
                                            <ul style="display: inline-flex;">
                                                <li>
                                                    <a href="{{ url('admin/role/'. $role->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('admin/role/'. $role->id.'/edit') }}" class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                </li>
                                                <li>
                                                    <form id="back-delete-form" action="{{ url('admin/role', [$role->id]) }}" method="POST">
                                                      @csrf
                                                      {{method_field('DELETE')}}
                                                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
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
