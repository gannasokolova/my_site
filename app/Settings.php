<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\UploadFilesController;
class Settings extends Model
{
    protected $table = 'settings';
    public $timestamps = false;
    protected $fillable = [
        'email',
        'phone',
        'user_top_menu',
        'admin_top_menu',
        'admin_left_menu',
        'default_user_role',
        'approve_comments',
        'admin_role',
        'default_user_avatar',
        'default_page_header',
        'skype'
    ];

    protected $enum = ['YES', 'NO',];

    public function rules($id = null)
    {
        return [
            'email' => 'required',
            'phone' => 'required',
            'user_top_menu' => 'required|exists:menus,id',
            'admin_top_menu' => 'required|exists:menus,id',
            'admin_left_menu' => 'required|exists:menus,id',
            'default_user_role' => 'required|exists:menus,id',
            'admin_role' => 'required|exists:menus,id',
            'approve_comments' => 'required|in:YES,NO',
            'image' => 'ext:jpg,gif,png,jpeg,image/jpeg,image/png',
            'default_page_header' => 'required|exists:pages,id',
            'skype' => 'required',
            'default_user_avatar' => 'ext:jpg,gif,png,jpeg,image/jpeg,image/png',
        ];
    }
    public function uploadFile($formData){
        if (isset($formData['default_user_avatar'])) {
            UploadFilesController::uploadFile('default_user_avatar',
                'png',
                $formData['default_user_avatar'],
                $this,
                200);
        }
    }
    public function roles()
    {
        return $this->hasOne('App\Roles', 'id', 'default_user_role');
    }

    public function adminRoles()
    {
        return $this->hasOne('App\Roles', 'id', 'admin_role');
    }

    public function userTopMenu()
    {
        return $this->hasOne('App\Menus', 'id', 'user_top_menu');
    }

    public function adminTopMenu()
    {
        return $this->hasOne('App\Menus', 'id', 'admin_top_menu');
    }

    public function adminLeftMenu()
    {
        return $this->hasOne('App\Menus', 'id', 'admin_left_menu');
    }

    public function pageHeader()
    {
        return $this->hasOne('App\Pages', 'id', 'default_page_header');
    }
}
