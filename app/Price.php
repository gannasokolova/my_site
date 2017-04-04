<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price';
    protected $fillable = [
        'title',
        'price_UAH',
        'order',
        'description',
        'days',
        'times',
        'status'
    ];

    protected $enum = ['PUBLISHED','DRAFT','PENDING'];

    public function getEnum(){
        return $this->enum;
    }

    public function rules($id = null){
        return [
            'title'         => 'required|max:30|unique:price,title,'.$id,
            'price_UAH'     => 'required|alpha_num',
            'days'          => 'required|max:20',
            'times'         => 'required|max:20',
            'order'         => 'required|max:11|unique:price,order,'.$id,
            'description'   => 'required|max:700',
            'status'        => 'required|in:PUBLISHED,DRAFT,PENDING',
        ];
    }

    static function findByStatus($status)
    {
        return Price::where('status', '=', $status)->orderBy('order')->get();
    }

}
