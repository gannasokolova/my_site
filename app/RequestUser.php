<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestUser extends Model
{
    protected $table    = 'request_user';
    protected $fillable = [
        'name',
        'phone',
        'user_id',
        'price_id'
    ];

    public function rules($id = null){
        return [
            'name'    => 'required|min:3',
            'phone'   => 'required|min:10|phone',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function user(){
        return $this->hasOne('App\Users', 'id', 'user_id');
    }

    public function price(){
        return $this->hasOne('App\Price', 'id', 'price_id');
    }
}
