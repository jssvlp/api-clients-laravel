<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Profile;

class Client extends Model
{
    protected $fillable = ['name','first_last_name','second_last_name','gender','birth_place','birth_date','status'];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function  addresses(){
        return $this->hasMany(Address::class);
    }
}
