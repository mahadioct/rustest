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
                                <div class="card-title text-dark">Edit Position
                                    #@if($position !=null){{$position->id}}@endif</div>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{route('position.index')}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-arrow-left"></i>
                                    back
                                </a>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('position.update') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="departmentName">Select Department</label>
                                                <select id="departmentName" type="text" name="department_id"
                                                        class="form-control" required>
                                                    @if(!$departments->isEmpty())
                                                        @foreach($departments as $item)
                                                            <option value="{{$item->id}}"
                                                                    @if($position !=null) @if($item->id == $position->department_id) selected @endif @endif>{{$item->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="positionName">Position Name</label>
                                                <input value="@if($position !=null){{$position->id}}@endif"
                                                       type="hidden" name="id">
                                                <input id="positionName"
                                                       value="@if($position !=null){{$position->name}}@endif"
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
