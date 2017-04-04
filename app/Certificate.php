<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\UploadFilesController;
use Illuminate\Support\Facades\Storage;
class Certificate extends Model
{
    protected $table = 'certificates';

    protected $fillable = [
        'image',
        'order',
        'alt'
    ];

    public function rules($id = null)
    {
        return [
            'image' => 'ext:jpg,jpeg,image/jpeg',
            'order' => 'required',
            'alt'   => 'required',
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
                700);
        }
    }

}
