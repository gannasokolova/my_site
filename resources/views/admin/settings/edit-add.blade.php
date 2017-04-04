@extends('admin.templates.default')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <p class="h2">
                    @if (!empty ($dataType->icon))
                        <img src="{{$dataType->icon}}" class="user_avatar">
                    @endif
                    {{$dataType->display_name_plural}}
                </p>
            </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <form role="form"
                      action="{{url('admin/'.$dataType->slug.'/update/'.$dataTypeContent->id)}}"
                      method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}


                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <label for="email" class="col-md-4 control-label">email для уведомлений</label>

                        <input type="email" class="form-control" name="email"
                               @if(old('email')){
                               value = "{{old('email')}}"
                               @elseif(!empty($dataTypeContent->email)){
                               value ="{!!$dataTypeContent->email !!}"
                               @endif
                               required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">

                        <label for="phone" class="col-md-4 control-label">Телефон</label>

                        <input type="phone" class="form-control" name="phone"
                               @if(old('phone')){
                               value = "{{old('phone')}}"
                               @elseif(!empty($dataTypeContent->phone)){
                               value ="{!!$dataTypeContent->phone !!}"
                               @endif
                               required autofocus>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('skype') ? ' has-error' : '' }}">

                        <label for="skype" class="col-md-4 control-label">Skype</label>

                        <input type="text" class="form-control" name="skype"
                               @if(old('skype')){
                               value = "{{old('skype')}}"
                               @elseif(!empty($dataTypeContent->skype)){
                               value ="{!!$dataTypeContent->skype !!}"
                               @endif
                               required autofocus>
                        @if ($errors->has('skype'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('skype') }}</strong>
                                </span>
                        @endif
                    </div>

                    @include('admin.templates.select_option',
                        [
                        'label'         => "Роль пользователя по умолчанию",
                        'name'          => "default_user_role",
                        'options'       => App\Roles::all(),
                        'key'           => "id",
                        'display_name'  => "display_name",
                        ])

                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">

                        <label for="image" class="col-md-4 control-label">Телефон</label>
                        @if(!empty($dataTypeContent->default_user_avatar) && Storage::disk('public')->exists($dataTypeContent->default_user_avatar))
                        <img
                                src="{{Storage::disk('public')->url($dataTypeContent->default_user_avatar)}}">
                        @endif
                        <input type="file" name="default_user_avatar">
                        @if ($errors->has('image'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @elseif(isset($errorsUplod))
                            <span class="help-block">
                                    <strong>{{ $errorsUplod }}</strong>
                        </span>
                        @endif

                    </div>

                    @include('admin.templates.select_option',
                        [
                        'label'         => "Роль администратора",
                        'name'          => "admin_role",
                        'options'       => App\Roles::all(),
                        'key'           => "id",
                        'display_name'  => "display_name",
                        ])
                    <?php $menus = App\Menus::all(); ?>
                    @include('admin.templates.select_option',
                         [
                         'label'         => "Меню сайта",
                         'name'          => "user_top_menu",
                         'options'       => $menus,
                         'key'           => "id",
                         'display_name'  => "name",
                         ])

                    @include('admin.templates.select_option',
                          [
                          'label'         => "Меню админ панели",
                          'name'          => "admin_top_menu",
                          'options'       => $menus,
                          'key'           => "id",
                          'display_name'  => "name",
                          ])
                    @include('admin.templates.select_option',
                          [
                          'label'         => "Меню админ панели левое",
                          'name'          => "admin_left_menu",
                          'options'       => $menus,
                          'key'           => "id",
                          'display_name'  => "name",
                          ])
                    @include('admin.templates.select_option',
                          [
                          'label'         => "Заголовок страницы",
                          'name'          => "default_page_header",
                          'options'       => App\Pages::all(),
                          'key'           => "id",
                          'display_name'  => "slug",
                          ])
                    <div class="form-group{{ $errors->has('approve_comments') ? ' has-error' : '' }}">

                        <label for="approve_comments" class="col-md-4 control-label">Модерация комментариев</label>
                        <input name="approve_comments" type='hidden' value='NO'>
                        <input type="checkbox" value="YES" name = "approve_comments"
                        <?php
                            if(old('approve_comments') == "YES"){
                                echo "checked";
                            }elseif($dataTypeContent->approve_comments == "YES"){
                                echo "checked";
                            }
                            ?>
                        >
                        @if ($errors->has('approve_comments'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('approve_comments') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary btn-block">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop




