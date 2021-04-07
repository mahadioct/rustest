@extends('layouts.back-end')
@section('title','RusTest | Dashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 border-right border-primary">
                                <div class="row">
                                    <div class="col-md-12 m-1">
                                        @if($user['profile_photo'] !=null)
                                            <img src="{{url($user['profile_photo'])}}" width="100%">
                                        @else
                                            <img src="{{asset('/')}}back-end/img/undraw_profile.svg" width="100%">
                                        @endif
                                    </div>
                                    <div class="col-md-12 text-center">
                                        @can('photo_upload')
                                            <button type="button" class="btn btn-sm btn-success"
                                                    onclick="uploadPhoto({{$user['id']}})">
                                                <i class="fa fa-edit"></i>
                                                Change
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <h5>@if($user != null){{$user['name']}}@endif</h5>
                                <p class="p-0 m-0">@if($user != null)E-Mail : {{$user['email']}}@endif</p>
                                <p class="p-0 m-0">@if($user != null)Position : {{$user['position_name']}}@endif</p>
                                <p class="p-0 m-0">@if(!empty($user['department_id']))Department :
                                    @foreach($user['department_id'] as $key => $data)
                                        {{$data->department_name}}@if($key+1 == count($user['department_id'])) @else
                                            , @endif
                                @endforeach
                                @endif
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
        function uploadPhoto(id) {
            $.ajax({
                url: '{{ route('user.upload.photo') }}',
                type: 'GET',
                data: {id: id},
                success: function (response) {
                    $('.largeModal .modal-content').html(response);
                    $('.largeModal').modal('show')
                }
            })
        }
    </script>
@endsection
