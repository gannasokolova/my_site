@extends('templates.default')

@section('content')

<div class="container-fluid questions">
    <div class="row">
        <div class="col-lg-7 col-md-8  col-sm-10   col-xs-12">
            <form class="main_form">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <span>ЗАДАТЬ ВОПРОС</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <p> Для незарегистрированных посетителей</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <label>Контактный email:</label>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <input type="email" name="email"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 ">
                        <label>Контактный телефон:</label>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <input type="phone" name="phone" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <p>Следующие ниже данные будут опубликованы:</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                        <label>Имя:</label>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <input type="text" name="name"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 ">
                        <label>Возраст: </label>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <input type="text" name="phone" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 ">
                        <label>Тема:</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <input type="text" name="title" />
                    </div>
                </div>
                <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <textarea name="about" placeholder="Суть вопроса"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <input class="button" type='submit' value="Отправить" />
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-5 col-md-4 col-sm-12 col-xs-12 list">
            @include('areas_work')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12  col-sm-12   col-xs-12">
            <p>Сегодня многие с удовольствием пользуются возможностью задать вопрос психологу онлайн и получить совет
                не просто как взгляд со стороны, а рекоммендацию профессионального психолога.
                При этом, сохранив анонимность, имея доступ к сервису круглосуточно.Таким образом, посетитель получает
                первичную консультацию онлайн.
            </p>
        </div>
    </div>
</div>
@stop