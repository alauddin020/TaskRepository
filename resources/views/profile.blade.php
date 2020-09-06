@extends('layouts.app')
@section('top')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><strong>{{$user->name}}</strong></div>
                    <div class="card-body">
                        <img style="max-height: 400px" class="img-fluid card-img-top" id="newProfilePhoto" src="/photo/{{$user->info->avatar}}" alt="Photo">
                        <a href="javascript:void(0)"  role="button" class="btn-outline-success btn mt-2 float-right" onclick="profilePicUpload()"><i class='fa fa-camera'></i> <span>Change Photo</span></a>
                        <form id="profilePhoto">
                            <input type="hidden" name="photo" value="{{$user->info->avatar}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="file" accept="image/*" name="avatar" id="customFile" style="display: none;">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>Other User Liked You</strong>
                    </div>
                    @if (count($user->like))
                        <div class="card-body">
                            <table class="table table-striped table-inverse">
                                <thead class="thead-inverse">
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($user->like as $key=>$user)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$user->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        profilePicUpload=()=>{
            $('#customFile').click();
        }
        $(function () {
            $("#customFile").on('change',function (e)
            {
                e.preventDefault();
                let form = $('#profilePhoto')[0];
                let data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: '{{route('profile')}}',
                    mimeType: "multipart/form-data",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function (data)
                    {
                        $('#profilePhoto')[0].reset();
                        $('#newProfilePhoto').attr('src','{{url('/photo/')}}/'+data);
                    }
                });
            });
        })
    </script>
@endsection
