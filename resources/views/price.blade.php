@extends('templates.default')
@section('page_script')
    <script src="{{asset ('css/js/send_email_request.js')}}"></script>
    <script src="{{asset ('css/js/phone_format.min.js')}}"></script>
    <script src="{{asset ('css/js/exchange_rate.js')}}"></script>
@stop
@section('content')
@section('content')
    <div class="container-fluid">
        <div class="row hide" id = "error_exchange">
            <div class="alert alert-info  col-lg-12 col-md-12 col-sm-12 col-xs-12" id ="error_info">

            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-10 col-md-offset-10 col-sm-offset-10 col-xs-12">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-success" id = "UAH" onclick = "exchangeRate(this)">UAH</button>
                    <button type="button" class="btn btn-success" id = "USD" onclick = "exchangeRate(this)">USD</button>
                    <button type="button" class="btn btn-success" id = "EUR" onclick = "exchangeRate(this)">EUR</button>
                </div>
            </div>
        </div>
<br>
            <?php $counter = 0; ?>
            @foreach($price as $value)
                <?php
                $counter++;
                if($counter == 1){
                    echo "<div class = 'row'>";
                }
                ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-success price">
                    <div class="panel-body">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <p class="text-center h3 text-success">{{$value->title}}</p>
                            <hr class = "hr_margin_15">
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 price_bold">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    Дни
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    {{$value->days}}
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    Время
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    {{$value->times}}
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <p class=" h3" id = "{{$value->id}}">
                                    {{$value->price_UAH}} грн
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <!--<hr class = "hr_margin_15">-->
                            <p class="text-center"><a type="button" class="btn btn-success btn-sm" onclick="show_form_request({{$value->id}})">Оставить заявку</a></p>
                        </div>

                    </div>
                    @if(strlen($value->description) > 200)
                        <div class="panel-heading" id = {{$value->id}}_short>
                            <p class="text-center">
                                {!! str_limit($value->description, $limit = 200, $end = '...') !!}
                                <button class="btn btn-link" href = "#" onclick=viewDetail("{{$value->id}}_short")> подробнее </button>
                            </p>
                        </div>

                        <div class="panel-heading hidden" id = "{{$value->id}}_full">
                            <p class="text-center">
                                {!! $value->description !!}
                                <button class="btn btn-link" href = "#" onclick=viewDetail("{{$value->id}}_short")> свернуть </button>
                            </p>
                        </div>
                    @else
                        <div class="panel-heading">
                            <p class="text-center">
                                {!! $value->description !!}
                            </p>
                        </div>
                    @endif

                </div>
            </div>
                <?php
                if($counter % 4 == 0){
                    echo "</div>";
                    $counter = 0;
                }
                ?>
        @endforeach

    </div>

        <div class="modal fade" role="dialog" id="open_email_send_form">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title h3" id="exampleModalLabel">Заявка на консультацию</p>
                        <button type="button" class="close" data-dismiss="modal" onclick="clear_info();" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="email_send"  method = "post" action="{{asset('/home/send_email')}}">
                            {{csrf_field()}}
                            <input type="hidden" class="form-control" name="price_id" id="price_id">
                            <div class="form-group">
                                <label for="name">Имя:</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Введите имя" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Телефон</label>
                                <input type="phone" name='phone' id = "phone" class="form-control" placeholder="Введите телефон" required>
                            </div>
                            <div class="form-group">
                                <div  class ='alert alert-warning hide' id = "error">

                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clear_info();">Закрыть</button>
                        <button type="button" class="btn btn-success" onclick="send_email(this);">Отправить</button>
                    </div>
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
@stop