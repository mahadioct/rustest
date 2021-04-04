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
                                <div class="card-title">Department List</div>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-sm btn-primary" onclick="CreateDepartment()">
                                    <i class="fa fa-plus"></i>
                                    Create
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">

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
        function CreateDepartment(){
            $.ajax({
                url:'{{ route('department.create') }}',
                type:'GET',
                data:{},
                success:function (response){
                    $('.largeModal .modal-content').html(response);
                    $('.largeModal').modal('show')
                }
            })
        }
    </script>
@endsection
