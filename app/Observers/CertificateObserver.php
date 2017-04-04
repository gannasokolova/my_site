<?php
namespace App\Observers;

use App\Certificate;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UploadFilesController;
class CertificateObserver
{
    public function deleted(Certificate $certificate)
    {
        if($certificate->image && Storage::disk('public')->exists($certificate->image)){
            if(!Storage::disk('public')->delete($certificate->image)){
                throw new Exception('Ошибка удаления файла');
            }
        }
    }
}