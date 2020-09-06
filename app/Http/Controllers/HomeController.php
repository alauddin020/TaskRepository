<?php

namespace App\Http\Controllers;

use App\User;
use App\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $lat = Auth::user()->info->lat;
        $lon = Auth::user()->info->lng;
        $distance = 5;
        //6371 ..23.7500756;//
        //111.045 ../90.382269;//
        $sqlDistance = DB::raw("6371 * acos(cos(radians(" . $lat . "))
        * cos(radians(user_infos.lat))
        * cos(radians(user_infos.lng) - radians(" . $lon . "))
        + sin(radians(" . $lat . "))
        * sin(radians(user_infos.lat)))");
        $users = UserInfo::with('user')
            ->select(
                'user_infos.user_id',
                'user_infos.lat',
                'user_infos.lng',
                'user_infos.gender',
                'user_infos.avatar',
                'user_infos.birthday'
            )
            ->selectRaw("{$sqlDistance} AS distance")
            ->havingBetween('distance', [1,$distance])
            ->whereNotIn('user_id',[Auth::id()])
            ->get();
        return view('home',compact('users'));
    }

    public function profile()
    {
        $user = User::with('info','like')->findOrFail(Auth::id());
        return view('profile',compact('user'));
    }

    public function photo(Request $request)
    {
        if ($request->ajax())
        {
            if ($request->hasFile('avatar'))
            {
                $user = Auth::user();
                $imageName = $user->id.'.'.$request->avatar->getClientOriginalExtension();
                $request->avatar->move(public_path('/photo'), $imageName);
                $image = User::findOrFail(Auth::id())->info;
                $image->avatar = $imageName;
                $image->save();
                return $imageName.'?'.rand();
            }
        }
    }
}
