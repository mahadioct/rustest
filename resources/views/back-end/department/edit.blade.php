@extends('layouts.back-end')
@section('title','RusTest | Department')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-title text-dark">Edit Department
                                    #@if($department !=null){{$department->id}}@endif</div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route('department.index')}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i>
                                    back
                                </a>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('department.update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="departmentName">Department Name</label>
                                                <input value="@if($department !=null){{$department->id}}@endif" type="hidden" name="id">
                                                <input id="departmentName" value="@if($department !=null){{$department->name}}@endif" type="text" name="name" class="form-control"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
