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
                                <div class="card-title text-dark">Edit Role #@if($role !=null){{$role->id}}@endif</div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route('role.index')}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i>
                                    back
                                </a>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('role.update') }}" method="post">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role Name</label>
                                        <input type="hidden" name="id" value="@if($role !=null){{$role->id}}@endif">
                                        <input id="role" type="text" name="name"
                                               value="@if($role !=null){{$role->name}}@endif"
                                               class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
