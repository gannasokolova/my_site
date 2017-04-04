@extends('templates.default')
@section('page_script')
    <script src="{{asset ('css/js/send_email_request.js')}}"></script>
    <script src="{{asset ('css/js/phone_format.min.js')}}"></script>
@stop
@section('content')

    <section class="home_image">
    </section>

    <section >
        <div class=" container-fluid">
            <div class="container col-lg-8 col-lg-offset-4 col-md-9 col-md-offset-3 home_form">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" >
                    <p class="h1 home_header hidden-xs">ПСИХОЛОГ <br> ТАТЬЯНА ЗВЕНИГОРОДСКАЯ</p>
                    <p class="h3 home_header hidden-lg hidden-md hidden-sm">ПСИХОЛОГ <br> ТАТЬЯНА ЗВЕНИГОРОДСКАЯ</p>
                    <p class="h4 home_header">ПСИХОЛОГИЧЕСКАЯ ПОМОЩЬ В ЛЮБОЙ СИТУАЦИИ</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs text-center">
                    <p class="h4 home_header">ЗАПИСАТЬСЯ НА КОНСУЛЬТАЦИЮ</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" >
                    <form class="form-inline" role="form" id="email_send"  method = "post" action="{{asset('/home/send_email')}}">
                        {{csrf_field()}}
                        <div class="form-group input-group-lg">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя" required>
                        </div>
                        <div class="form-group input-group-lg">
                            <input type="phone" name='phone' class="form-control" id="phone" placeholder="Введите телефон" required>
                        </div>
                        <button
                                type="submit"
                                class="btn btn-success btn-lg"
                                onclick="send_email(this);"
                                data-toggle="popover"
                                data-placement="bottom"
                                data-trigger="focus"
                                data-content=""
                                id = "submit"
                                >
                            Оставить заявку
                        </button>
                    </form>
                </div>
            </div>

            </div>

            <div class="modal fade" role="dialog" id ="success">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p class="h4 text-center"> Спасибо за заявку. Я Вам перезвоню. </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </section>
    <section>
        <div class="row home_advantage">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center">
                <img src ="{{asset('images/advantage12.png')}}" alt="" class="advantage">
                <p class="h3 advantage">
                    <?=date('Y') - 2007 ?> лет частной практики
                </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center">
                <img src ="{{asset('images/advantage2.png')}}" alt="" class="advantage">
                <p class="h3 advantage">
                    Профессионализм и высокий уровень квалификации
                </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center">
                <img src ="{{asset('images/advantage3.png')}}" alt="" class="advantage">
                <p class="h3 advantage">
                    Удобный график работы
                </p>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center">
                <img src ="{{asset('images/advantage4.png')}}" alt="" class="advantage">
                <p class="h3 advantage">
                    Личные встречи и дистанциoнная помощь
                </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center">
                <img src ="{{asset('images/advantage5.png')}}" alt="" class="advantage">
                <p class="h3 advantage">
                    Полная конфиденциальность
                </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 text-center">
                <img src ="{{asset('images/advantage7.png')}}" alt="" class="advantage">
                <p class="h3 advantage">
                    Работа с людьми разных возрастных категорий
                </p>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container-fluid" >
        <div class="row">
            <p class="h1 text-center"> Контакты</p>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <script type="text/javascript" charset="utf-8" async
                        src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=arNvyBwD0Kyh0FjIxMIdQwj3bSU9kCHH&amp;height=250&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>

            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 contact header_1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="h2"><i class="glyphicon glyphicon-phone"></i>
                        {{App\Settings::first()->phone}}</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <p class="h2"> <img src="images/rsz_2skype.png" alt="Скайп:"/> {{App\Settings::first()->skype}}</p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <p class="h2"><i class="glyphicon glyphicon-map-marker">

                            </i> Адрес: г. Киев, ул. Спасская, 8А, офис 1 (м. Контрактовая площадь)</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <footer>
        <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center small">
                <hr> COPYRIGHT &copy; <?=date('Y')?> УКРПСИХОЛОГ
            </div>
        </div>
    </footer>
@stop
