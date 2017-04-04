<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UploadFilesController;
class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = [
        'title',
        'body',
        'status',
        'slug',
        'category_id',
        'image'
    ];
    protected $enum = ['PUBLISHED','DRAFT','PENDING'];

    public function rules($id = null)
    {
        return [
            'title'       => 'required|min:3|max:100|unique:articles,title,'.$id,
            'body'        => 'required',
            'status'      => 'required|in:PUBLISHED,DRAFT,PENDING',
            'slug'        => 'required|max:15|unique:articles,slug,'.$id,
            'category_id' => 'required|exists:categoriesArticles,id',
            'image'       => 'ext:jpg,jpeg,image/jpeg',
        ];
    }

    public function uploadFile($formData){
        if (isset($formData['delete_image']) && !isset($formData['image'])) {
            UploadFilesController::deleteFile('image', $this);
        }
        if (isset($formData['image'])) {
            UploadFilesController::uploadFile('image',
                $formData['image']->getClientOriginalExtension(),
                $formData['image'],
                $this,
                400);
        }
    }
    public function getEnum(){
        return $this->enum;
    }

    public function comments()
    {
        return $this->hasMany('App\CommentsArticle','article_id','id');
    }

    public function categories()
    {
        return $this->hasOne('App\CategoriesArticles','id','category_id');
    }

    static function findBySlug($slug)
    {
        return Article::where('slug', $slug)->First();
    }

    static function findByStatus($status)
    {
        return Article::where('status', '=', $status);
    }
}
