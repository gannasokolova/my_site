@extends('templates.default')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <script type="text/javascript" charset="utf-8" async
                    src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=arNvyBwD0Kyh0FjIxMIdQwj3bSU9kCHH&amp;height=450&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 contact header_1">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="images/tel.png" alt="Телефон:"/>
                    <span>(095) 013-33-49</span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="images/skipe.png" alt="Скайп:"/>
                    <span>tatyana_psiholog</span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <img src="images/address.png" alt=""/>
                    <span>Адрес: г. Киев, ул. Спасская, 8А, офис 1 (м. Контрактовая площадь)</span>
                </div>
            </div>
        </div>
    </div>
</div>
@stop