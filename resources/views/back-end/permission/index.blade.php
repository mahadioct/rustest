@extends('layouts.back-end')
@section('title','RusTest | Permission')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title text-dark">Permission List</div>
                            </div>
                            <div class="col-md-6 text-right">
                                @can('create')
                                    <button class="btn btn-sm btn-primary" onclick="createPermission()">
                                        <i class="fa fa-plus"></i>
                                        Create
                                    </button>
                                @endcan
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered text-center" id="permissionTable" width="100%"
                                       cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Permission Name</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$permissions->isEmpty())
                                        @foreach($permissions as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{date('d.m.Y',strtotime($item->created_at))}}</td>
                                                <td>
                                                    @can('edit')
                                                        <a href="{{route('permission.edit',['id'=> $item->id])}}"
                                                           type="button" class="btn btn-sm btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete')
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="deletePermission({{$item->id}})">
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
            $('#permissionTable').DataTable();
        });

        function createPermission() {
            $.ajax({
                url: '{{ route('permission.create') }}',
                type: 'GET',
                data: {},
                success: function (response) {
                    $('.largeModal .modal-content').html(response);
                    $('.largeModal').modal('show')
                }
            })
        }

        function deletePermission(id) {
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
                        url: '{{ route('permission.destroy') }}',
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
