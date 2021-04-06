@extends('layouts.back-end')
@section('title','RusTest | Users')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title text-dark">User List</div>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-sm btn-primary" onclick="CreatePosition()">
                                    <i class="fa fa-plus"></i>
                                    Create
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered text-center" id="userTable" width="100%"
                                       cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>E-Mail</th>
                                        <th>Position Name</th>
                                        <th>Department Name</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($users))
                                        @foreach($users as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item['name']}}</td>
                                                <td>{{$item['email']}}</td>
                                                <td>{{$item['position_name']}}</td>
                                                <td>
                                                    @if(!empty($item['department_name']))
                                                        @foreach($item['department_name'] as $key => $data)
                                                            {{$data->department_name}}@if($key+1 == count($item['department_name'])) @else
                                                                , @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>{{date('d.m.Y',strtotime($item['updated_at']))}}</td>
                                                <td>
                                                    <a href="{{route('user.edit',['id' => $item['id']])}}"
                                                       type="button" class="btn btn-sm btn-warning">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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
            $('#userTable').DataTable();
        });
    </script>
@endsection
