<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class UserInfo extends Model
{
    protected $guarded = [];
    protected $appends = ['age'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
//        return Carbon::parse($this->attributes['birthday'])->diff(Carbon::now())
//            ->format('%y years, %m months and %d days');
    }
}
