@extends('layouts.back-end')
@section('title','RusTest | Assign Role')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title text-dark">Assign Role to user
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
                        <form action="{{ route('user.assign.role.update') }}" method="post">
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
                                                       readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="roleName">Select Role</label>
                                                <select id="roleName" type="text" name="role_id[]"
                                                        multiple="multiple"
                                                        class="form-control" required>
                                                    @if(!$roles->isEmpty())
                                                        @foreach($roles as $item)
                                                            <option value="{{$item->id}}"
                                                                    @if(!$assignedRoles->isEmpty())
                                                                    @foreach($assignedRoles as $data)
                                                                    @if($item->id == $data->role_id) selected @endif
                                                                @endforeach
                                                                @endif
                                                            >{{$item->name}}</option>
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
            $('#roleName').select2();
        });
    </script>
@endsection
