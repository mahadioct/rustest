@extends('layouts.back-end')
@section('title','RusTest | Role')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title text-dark">Role List</div>
                            </div>
                            <div class="col-md-6 text-right">
                                @can('create')
                                    <button class="btn btn-sm btn-primary" onclick="createRole()">
                                        <i class="fa fa-plus"></i>
                                        Create
                                    </button>
                                @endcan
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered text-center" id="roleTable" width="100%"
                                       cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Permissions</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$roles->isEmpty())
                                        @foreach($roles as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>
                                                    @if(!$item->permissions->isEmpty())
                                                        @foreach($item->permissions as $key => $data)
                                                            {{$data->name}}@if($key+1 == count($item->permissions)) @else
                                                                , @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>{{date('d.m.Y',strtotime($item->created_at))}}</td>
                                                <td>
                                                    @can('edit')
                                                        <a href="{{route('role.assign.permission',['id'=> $item->id])}}"
                                                           type="button" class="btn btn-sm btn-success">
                                                            <i class="fa fa-edit"></i>
                                                            Assign Permission
                                                        </a>
                                                        <a href="{{route('role.edit',['id'=> $item->id])}}"
                                                           type="button" class="btn btn-sm btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete')
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="deleteRole({{$item->id}})">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        $(document).ready(function () {
            $('#roleTable').DataTable();
        });

        function createRole() {
            $.ajax({
                url: '{{ route('role.create') }}',
                type: 'GET',
                data: {},
                success: function (response) {
                    $('.largeModal .modal-content').html(response);
                    $('.largeModal').modal('show')
                }
            })
        }

        function deleteRole(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('role.destroy') }}',
                        type: 'GET',
                        data: {id: id},
                        success: function () {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            location.reload();
                        },
                        error: function () {
                            Swal.fire(
                                'Warning!',
                                'Something went wrong!',
                                'error'
                            )
                        }
                    })
                }
            })
        }
    </script>
@endsection
