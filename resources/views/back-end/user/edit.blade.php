@extends('layouts.back-end')
@section('title','RusTest | User Edit')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title text-dark">Edit User
                                    #@if($user != null){{$user['id']}}@endif</div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route('user.index')}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i>
                                    back
                                </a>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('user.update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">User Name</label>
                                                <input id="name"
                                                       value="@if($user != null){{$user['id']}}@endif"
                                                       type="hidden" name="id" class="form-control"
                                                       required>
                                                <input id="name"
                                                       value="@if($user != null){{$user['name']}}@endif"
                                                       type="text" name="name" class="form-control"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">User E-Mail</label>
                                                <input id="email"
                                                       value="@if($user != null){{$user['email']}}@endif"
                                                       type="text" name="email" class="form-control"
                                                       required>
                                            </div>
                                            <div class="form-group">
                                                <label for="departmentName">Select Department</label>
                                                <select id="departmentName" type="text" name="department_id[]"
                                                        multiple="multiple"
                                                        class="form-control" required>
                                                    @if(!$departments->isEmpty())
                                                        @foreach($departments as $item)
                                                            <option value="{{$item->id}}"
                                                                    @if($user != null)
                                                                    @foreach($user['department_id'] as $data)
                                                                    @if($item->id == $data->department_id) selected @endif
                                                                @endforeach
                                                                @endif
                                                            >{{$item->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="positionName">Select Position</label>
                                                <select id="positionName" type="text" name="position_id"
                                                        class="form-control" required>
                                                    @if(!$positions->isEmpty())
                                                        @foreach($positions as $item)
                                                            <option value="{{$item->id}}"
                                                                    @if($user != null) @if($item->id == $user['position_id']) selected @endif @endif>{{$item->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#departmentName').select2();
        });
    </script>
@endsection
