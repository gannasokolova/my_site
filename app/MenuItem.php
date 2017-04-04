<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table    = 'menu_items';
    protected $fillable = ['title', 'url', 'menu_id', 'order'];

    public function menus(){
        return $this->hasOne('App\Menus', 'id', 'menu_id');
    }

    public function rules($id = null){
        return [
            'menu_id' => 'required|exists:menus,id',
            'title'   => 'required|max:20|unique:menu_items,title,'.$id,
            'url'     => 'required',
            'order'   => 'required|numeric',
        ];
    }

    public function messageValidate(){
        return [
            'alpha_dash' => "Поле должно"
        ];
    }
}
