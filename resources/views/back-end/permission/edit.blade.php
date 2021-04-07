@extends('layouts.back-end')
@section('title','RusTest | Permission Edit')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title text-dark">Edit Permission
                                    #@if($permission !=null){{$permission->id}}@endif</div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route('permission.index')}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i>
                                    back
                                </a>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('permission.update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="permissionName">Permission Name</label>
                                                <input value="@if($permission !=null){{$permission->id}}@endif"
                                                       type="hidden" name="id">
                                                <input id="permissionName"
                                                       value="@if($permission !=null){{$permission->name}}@endif"
                                                       type="text" name="name" class="form-control"
                                                       required>
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
