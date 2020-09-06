@extends('layouts.app')
@section('top')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Data shows around 5 KM</strong></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if (count($users))
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Distance</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $key=>$user)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><img style="height: 40px;width: 40px;border-radius: 50%" class="img-thumbnail mr-2" src="" alt="Photo" srcset="/photo/{{$user->avatar}}">{{$user->user->name}}<sub class="ml-1">(Age: {{$user->age}} Years)</sub></td>
                                        <td>{{$user->gender==1 ? 'Male' : 'Female'}}</td>
                                        <td>{{round($user->distance,2)}} KM</td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="like('{{$user->user_id}}')"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>  {{--({{$user->user->likedUsers->count()}})--}}
                                            <a href="javascript:void(0)" onclick="dislike('{{$user->user_id}}')"><i class="fa fa-thumbs-o-down ml-2" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        like=(otherId)=>{
            $.ajax({
                url: '{{route('like')}}',
                type: 'POST',
                data:{likedUser:otherId,_token:'{{csrf_token()}}'},
                success: function (data) {
                    if (data.success)
                    {
                        alert(data.success);
                    }
                    else{
                        console.log(data)
                    }
                }
            })
        }
        dislike=(otherId)=>{
            $.ajax({
                url: '{{route('like')}}',
                type: 'PUT',
                data:{dislikedUser:otherId,_token:'{{csrf_token()}}'},
                success: function (data) {
                    if (data.success)
                    {
                        alert(data.success);
                    }
                }
            })
        }
    </script>
@endsection
