@extends('templates.default')
@section('page_script')
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" type="text/css" href="{{asset ('css/css/elastislide.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset ('css/css/custom.css')}}" />
    <script src="{{asset ('css/js/modernizr.custom.17475.js')}}"></script>
    <script type="text/javascript" src="{{asset ('css/js/jquery.elastislide.js')}}"></script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $( '#carousel' ).elastislide( {
                minItems : 2
            });
        });

    </script>
@stop
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
            <div class="about_me_content white_color">
                <p class=" h1 text-center text-success"> Практикующий киевский психолог Звенигородская Татьяна - помогаю найти простые ответы на сложные вопросы</p>
               <hr>
                    <img src="{{asset('images/about_me.jpg')}}" class="img-thumbnail about_me_photo"  alt= "Психолог Звенигородская Татьяна"/>
                <div class="about_me_content_text">
                <p>Здравствуйте, меня зовут Татьяна Звенигородская, и я рада, что вы заглянули  на мою страничку . Немного о себе:
                я семейный психолог, специалист по мужско-женским отношениям и сексуальным отношениям в паре. Психологию я считаю своим
                призванием так как убедилась в ее эффективности на собственном опыте.  Отношениями я интересуюсь очень давно и имею более
                чем 10 летний опыт в вопросах поиска парнера, построения отношений и выхода из различных трудностей , которые могут
                возникать в паре, таких как недостаток внимания, отсутствие свободного времени, семейные кризисы, потеря сексуального
                возбуждения и влечения друг к другу, профессиональная нереализованность, отсутствие общих интересов и тем для разговора,
                расхождения в сексуальных предпочтениях, денежные конфликты, измены, конфликты по поводу родственников, вопросы, касающиеся
                воспитания детей, потери близких. </p>

                <p>Я очень люблю свою работу, за то, что на каждом сеансе встречаю в своем кабинете уникального  человека, со своим жизненным
                    опытом,  способами взаимодействия с собой и миром, строящим свою жизнь определенным образом. В своем профессиональном
                    развитии,  я  убедилась в том, что у каждого человека есть все ресурсы и возможности для решения той или иной задачи,
                    но они иногда не используются или попросту исчерпаны, или не найдены и тогда можно заручиться поддержкой специалиста</p>

                <p>Психотерапия– это пространство для людей, готовых к своим изменениям, смело бросающим вызов привычным стереотипам и
                    преодолевающих трудности, ограждающим движение на пути к себе. Это встреча человека с самим собой, это возможность увидеть свое
                    настоящее лицо, которое в погоне за соответствие стандартам, могло быть утеряно частично или полностью, это постоянное движение
                    в своем собственном развитии и улучшение качества своей жизни</p>

                <p>Буду рада присутствовать рядом с Вами и поддерживать, когда вам трудно, выступать свидетелем и защитником на  пути к себе</p>

                <p>Спасибо за внимание и до скорой встречи!!!</p>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 hidden-sm hidden-xs" >
            @include('areas_work')
        </div>
    </div>
    <div class="row ">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
            <div class="education white_color">
                <div class=" text-center small education_header text-uppercase text-success">ОСНОВНОЕ ОБРАЗОВАНИЕ</div><br>
                <span class = "year text-success">2006-2011</span>
                <p>НПУ им. М.П. Драгоманова , институт педагогики и психологии, специальность
                    «Практическая психология», квалификация магистр педагогического образования;
                    преподаватель психологии; практический психолог.</p>
                <span class = "year text-success">2004-2009</span>
                <p>Государственный университет информатики и искусственного интеллекта,
                    специальность «Религиознавство», квалификация религиовед, преподаватель
                    философских и религиоведческих дисциплин</p>
            </div>

            <div>

                    <!-- Elastislide Carousel -->
                    <ul id="carousel" class="elastislide-list">
                        <p class="text-success text-center"> СЕРТИФИКАТЫ</p>
                        @foreach ($certificates as $certificate)
                            @if(Storage::disk('public')->exists($certificate->image))
                                <li>
                                    <a data-toggle="modal" data-target=".pop-up-{{$certificate->id}}" href="#">
                                        <img class = "img-thumbnail certificate" src="{{Storage::disk('public')->url($certificate->image)}}" alt="{{$certificate->alt}}">
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <!-- End Elastislide Carousel -->
                    <!--
                    <div class="col-lg-6 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-8 col-sm-offset-2 hidden-sm hidden-xs">
                        <img src="images/book1.png" alt="Образование">
                    </div> -->
            </div>

        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="education white_color">
                <div class =" text-center small education_header text-uppercase text-success">ДОПОЛНИТЕЛЬНОЕ ОБРАЗОВАНИЕ</div><br>
                <span class = "year text-success">2009-2010</span>
                <p>Участник терапевтической группы NEST Croup Counselling Programme:
                    new experience for survivors of trauma (работа с психическими травмами)
                </p>
                <span class = "year text-success">2010, 2012</span>
                <p>Участник конференции ПСИКОН</p>
                <span class = "year text-success">2012-2014</span>
                <p>Киевский Гештальт Университет, «Введение в метод - начало профессионального
                    пути" (І-II ступень). Обучающая группа по гештальт терапии и групповой
                    психотерапии в гештальт подходе.</p>
                <span class = "year text-success">2013-2014</span>
                <p>«Эриксоновский гипноз и гипнотерапия» - углубленый курс.</p>
                <span class = "year text-success">2013-2016</span>
                <p>Киевский Гештальт Университет, II ступень. Обучающая группа по гештальт терапии и групповой психотерапии в гештальт подходе..</p>
                <span class = "year text-success">Июль 2014</span>
                <p>Участие в психологическом интенсиве: «Свобода быть разным»</p>
                <span class = "year text-success">2015-2016</span>
                <p>Специализация «Гештальт-подход к семейной и парной терапии»</p>
                <span class = "year text-success">2015-2016</span>
                <p>Специализация «Гештальт-подход в развитии сексуальности»</p>
            </div>
        </div>
    </div>

    <div class="row ">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <!-- Elastislide Carousel -->
            <ul id="carousel" class="elastislide-list">
                @foreach ($certificates as $certificate)
                    <img class = "img-thumbnail" src="{{Storage::disk('public')->url($certificate->image)}}" alt="{{$certificate->alt}}">
                    @if(Storage::disk('public')->exists($certificate->image))
                        <li>
                            <a data-toggle="modal" data-target=".pop-up-{{$certificate->id}}" href="#">
                                <img class = "img-thumbnail" src="{{Storage::disk('public')->url($certificate->image)}}" alt="{{$certificate->alt}}">
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <!-- End Elastislide Carousel -->
        </div>
    </div>

</div>
@foreach ($certificates as $certificate)
    @if(Storage::disk('public')->exists($certificate->image))
        <div class="modal fade pop-up-{{$certificate->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <img src="{{Storage::disk('public')->url($certificate->image)}}" class="img-responsive center-block" alt="">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal mixer image -->
    @endif
@endforeach
<footer>
<div class="row ">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center small">
        <hr> COPYRIGHT &copy; <?=date('Y')?> УКРПСИХОЛОГ
    </div>
</div>
</footer>


@stop