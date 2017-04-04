@extends('admin.templates.default')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <p class="h2 text-center">
                    @if (!empty ($dataType->icon))
                        <img src="{{$dataType->icon}}" class="user_avatar">
                    @endif
                    {{ $dataType->display_name_singular }}
                </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-right">
                <a href="{{url('admin/'.$dataType->slug.'/edit/'.$dataTypeContent->id)}}" class="btn btn-primary edit  pull-right">
                    Правка
                </a>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @if (Session::has('errors'))
                    <div class="alert alert-danger">
                        <strong>Ошибка:</strong>
                        {{session('errors')}}
                    </div>
                @elseif(Session::has('message'))
                    <div class="alert alert-success">
                        <strong>Успешно!</strong>
                        {{session('message')}}
                    </div>
                @endif
                @if(isset($errorsUplod))
                    <div class="alert alert-danger">
                        <strong>Ошибка:</strong>
                        {{$errorsUplod}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-bordered">
                    <div class="panel-body text-center">

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">email для уведомлений</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <p class="h4"> {!! $dataTypeContent->email !!} </p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">Телефон</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <p class="h4"> {!! $dataTypeContent->phone !!} </p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">Skype</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <p class="h4"> {!! $dataTypeContent->skype !!} </p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">Модерация комментариев</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <input type="checkbox" disabled="disabled"
                                       @if($dataTypeContent->approve_comments == 'YES')
                                       checked
                                        @endif
                                >
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">Роль пользователя по умолчанию</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <p class="h4">{{$dataTypeContent->roles->display_name}}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">Аватар пользователя по умолчанию</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                @if(!empty($dataTypeContent->default_user_avatar) && Storage::disk('public')->exists($dataTypeContent->default_user_avatar))
                                    <img
                                            src="{{Storage::disk('public')->url($dataTypeContent->default_user_avatar)}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">Роль администратора</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <p class="h4">{{$dataTypeContent->adminRoles->display_name}}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">Меню сайта</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <p class="h4">{{$dataTypeContent->userTopMenu->name}}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">Меню админ панели</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <p class="h4">{{$dataTypeContent->adminTopMenu->name}}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">Меню админ панели левое</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <p class="h4">{{$dataTypeContent->adminLeftMenu->name}}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <p class="h4">Заголовок страницы</p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <p class="h4">{{$dataTypeContent->pageHeader->slug}}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop