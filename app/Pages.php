<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Settings;

class Pages extends Model
{
    protected $fillable = [
        'title',
        'meta_description',
        'meta_keywords',
        'slug',
    ];

    static function findSlug($slug){
        $page = Pages::where('slug', '=', $slug)->first();
        return $page ? $page : Pages::find(Settings::first()->default_page_header);
}
    public function rules($id = null)
    {
        return [
            'title'            => 'required',
            'meta_description' => 'required',
            'meta_keywords'    => 'required',
            'slug'             => 'required|max:15',
        ];
    }
}
