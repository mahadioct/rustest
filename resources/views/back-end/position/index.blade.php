@extends('layouts.back-end')
@section('title','RusTest | Position')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title text-dark">Position List</div>
                            </div>
                            <div class="col-md-6 text-right">
                                @can('create')
                                    <button class="btn btn-sm btn-primary" onclick="CreatePosition()">
                                        <i class="fa fa-plus"></i>
                                        Create
                                    </button>
                                @endcan
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered text-center" id="positionTable" width="100%"
                                       cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Position Name</th>
                                        <th>Department Name</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$positions->isEmpty())
                                        @foreach($positions as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->department_name}}</td>
                                                <td>{{date('d.m.Y',strtotime($item->created_at))}}</td>
                                                <td>
                                                    @can('edit')
                                                        <a href="{{route('position.edit',['id'=> $item->id])}}"
                                                           type="button" class="btn btn-sm btn-warning">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('delete')
                                                        <button type="button" class="btn btn-sm btn-danger"
                                                                onclick="deletePosition({{$item->id}})">
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
        // sleep time expects milliseconds
        function sleep(time) {
            return new Promise((resolve) => setTimeout(resolve, time));
        }

        $(document).ready(function () {
            $('#positionTable').DataTable();
        });

        function CreatePosition() {
            $.ajax({
                url: '{{ route('position.create') }}',
                type: 'GET',
                data: {},
                success: function (response) {
                    $('.largeModal .modal-content').html(response);
                    $('.largeModal').modal('show')
                }
            })
        }

        function deletePosition(id) {
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
                        url: '{{ route('position.destroy') }}',
                        type: 'GET',
                        data: {id: id},
                        success: function () {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            sleep(3000).then(() => {
                                location.reload();
                            });

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
