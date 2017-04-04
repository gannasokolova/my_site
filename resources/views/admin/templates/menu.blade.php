<?php
$menuItems = isset($menuItems) ? $menuItems : App\MenuItem::whereHas('menus', function ($query) {
                                $query->where('name', '=', 'user');
                            })->orderBy('order')->get();
?>
<!-- Меню navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">МЕНЮ</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to($menuItems->first()->url)}}" target="{{$menuItems->first()->target}}" class="navbar-brand">{{ config('app.name') }}</a>
        </div>
        <li class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($menuItems as $menuItem)
                    <li class="{{ Request::is(trim($menuItem->url, '/')) ? 'active' : '' }}">
                        @if (!empty ($menuItem->icon_class))
                            <i class="{{ $menuItem->icon_class}}"></i>
                        @endif
                        <a href="{{URL::to($menuItem->url)}}" target="{{$menuItem->target}}">{{$menuItem->title}}</a>
                    </li>
                @endforeach

                @foreach($rightMenuItems as $menuItem)
                    <li class="{{ Request::is(trim($menuItem->url.'/browse', '/')) ? 'active' : '' }} hidden-lg hidden-md">
                        <a href="{{URL::to($menuItem->url.'/browse')}}">
                                {{$menuItem->title}}
                        </a>
                     </li>
                @endforeach
            </ul>
            <ul class="nav navbar-nav navbar-right exit">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Войти</a></li>
                    <li><a href="{{ url('/register') }}">Регистрация</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            @if(!empty(Auth::user()->avatar) && Storage::disk('public')->exists(Auth::user()->avatar))
                                <img src="{{Storage::disk('public')->url(Auth::user()->avatar)}}" class="img-circle user_avatar" alt="avatar">
                            @endif
                            {{ Auth::user()->name }}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Выйти
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="collapse navbar-collapse">
            <div class="list-group">
                @foreach($rightMenuItems as $menuItem)
                <a href="{{URL::to($menuItem->url.'/browse')}}"
                   target="{{$menuItem->target}}"
                   class="{{ Request::is(trim($menuItem->url.'/*', '/')) ? 'active list-group-item ' : 'list-group-item ' }}">
                    @if (!empty ($menuItem->icon_class))
                        <i class="{{ $menuItem->icon_class}}"></i>
                    @endif
                    {{$menuItem->title}} <i class="glyphicon glyphicon-menu-right pull-right"></i>
                </a>
                @endforeach
            </div>
        </div>
    </div>

