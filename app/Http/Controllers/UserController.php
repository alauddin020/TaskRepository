<?php

namespace App\Http\Controllers;

use App\UserLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $likedUser = $request->likedUser;
        $isLikedAlready = UserLike::where([
            ['user_id', '=', $likedUser],
            ['liked_user_id', '=', Auth::id()],
        ])->orWhere([
            ['user_id', '=', Auth::id()],
            ['liked_user_id', '=', $likedUser],
        ])->first();

        if ($isLikedAlready) {
            if ($isLikedAlready->send_user_id!=Auth::id() && $isLikedAlready->unlike==true)
            {
                $isLikedAlready->is_mutual = false;
                $isLikedAlready->unlike = false;
                $isLikedAlready->send_user_id =Auth::id();
                $isLikedAlready->save();
                return response()->json(['success'=>'You like this user']);
            }
            elseif ($isLikedAlready->send_user_id==Auth::id() && $isLikedAlready->unlike==true)
            {
                $isLikedAlready->is_mutual = false;
                $isLikedAlready->unlike = false;
                $isLikedAlready->send_user_id =Auth::id();
                $isLikedAlready->save();
                return response()->json(['success'=>'You like this user']);
            }
            elseif ($isLikedAlready->send_user_id!=Auth::id() && $isLikedAlready->is_mutual==false)
            {
                $isLikedAlready->is_mutual = true;
                $isLikedAlready->unlike = false;
//                $isLikedAlready->send_user_id =Auth::id();
                $isLikedAlready->save();
//                return response()->json(['success'=>'You like this user']);
                return response()->json(['success'=>'It\'s a Match!']);
            }
            elseif($isLikedAlready->is_mutual == true){

                return response()->json(['success'=>'It\'s a Match!']);
            }
            else{
                return response()->json(['success'=>'You already like this user']);
            }
        }
        elseif(empty($isLikedAlready)){
            UserLike::firstOrCreate([
                'user_id' => Auth::id(),
                'liked_user_id' => $likedUser,
                'is_mutual' => $isLikedAlready ? true : false,
                'unlike' => false,
                'send_user_id'=>Auth::id()
            ]);
            return response()->json(['success'=>'You like this user']);
        }

    }

    public function dislike(Request $request)
    {
        $likedUser = $request->dislikedUser;
        $isLikedAlready = UserLike::where([
            ['user_id', '=', $likedUser],
            ['liked_user_id', '=', Auth::id()],
        ])->orWhere([
            ['user_id', '=', Auth::id()],
            ['liked_user_id', '=', $likedUser],
        ])->first();
        if ($isLikedAlready) {
            $isLikedAlready->is_mutual = false;
            $isLikedAlready->unlike = true;
            $isLikedAlready->send_user_id =Auth::id();
            $isLikedAlready->save();
            return response()->json(['success'=>'You unlike this user']);
        }
        elseif(empty($isLikedAlready)){
            UserLike::firstOrCreate([
                'user_id' => Auth::id(),
                'liked_user_id' => $likedUser,
                'is_mutual' => false,
                'unlike' => true,
                'send_user_id'=>Auth::id()
            ]);
            return response()->json(['success'=>'You unlike this user']);
        }
    }
    public function listLikedUsers()
    {
        $user = Auth::user();

        return response()->json([
            'status' => true,
            'data' => $user->likedUsers()->get()
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
