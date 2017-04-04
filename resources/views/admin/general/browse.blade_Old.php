@extends('admin.templates.default')
@section('content')
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <p class="h2">
                    @if (!empty ($dataType->icon))
                        <img src="{{$dataType->icon}}" class="user_avatar">
                    @endif
                    {{ $dataType->display_name_plural }}
                    <a href="{{URL::to('admin/'.$dataType->slug.'/add')}}" class="btn btn-success">
                        Добавить
                    </a>
                </p>
            </div>

            <div class="col-lg-5 col-md-5 col-sm-12 hidden-xs">
                <?php
                $countRecordOnPage = [10,25,50,100];
                if(isset($_GET) && !empty($_GET['paginate'])){
                    $selectUser = $_GET['paginate'];
                }else{
                    $selectUser = $countRecordOnPage [0];
                }
                ?>
                <label>Показать
                    <select onchange="document.location=this.options[this.selectedIndex].value"
                            class=" input-sm ">
                        @foreach($countRecordOnPage as $value)
                            <option
                                    value=
                                    "{{url ('admin/'.$dataType->slug.'/browse/?paginate='.$value)}}"
                                    {{($value ==  $selectUser) ? "selected" : ""}}>
                                {{$value}}
                            </option>
                        @endforeach
                    </select> записей на странице
                </label>
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
                    <div class="panel-body table-responsive">
                        <table class="tablesorter table  table-bordered table-hover" id ="tablesorter">
                            <thead>
                                <tr>
                                    <?php
                                    $counter = 0;
                                    $class = "hidden-xs"
                                    ?>
                                    @foreach( $dataType->browseRows as $rowName)
                                    <?php $counter++; ?>
                                        <div>
                                            <th class = "{{($counter != 1) ? $class : ''}}">{{ $rowName->display_name }}</th>
                                        </div>
                                    @endforeach

                                        @yield('rowName')

                                    <th class ="text-center "> Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $dataTypeContent as $data)
                                    <tr>
                                     <?php $counter=0; ?>
                                    @foreach( $dataType->browseRows as $row)
                                        <?php $counter++; ?>
                                        @if($row->type == "image")
                                            <td class = "{{($counter != 1) ? $class : ''}}"><img class=" img-circle user_avatar"
                                                        src="{{asset( $data->{$row->field})}}"></td>
                                        @elseif($row->type == "checkbox")
                                            <td class = "{{($counter != 1) ? $class : ''}} ">
                                                <input type="checkbox" disabled="disabled"
                                                @if($data->{$row->field} == 1)
                                                    checked
                                                @endif
                                                >
                                            </td>
                                        @else
                                            <td class = "{{($counter != 1) ? $class : ''}}"> {!! $data->{$row->field} !!}</td>
                                        @endif

                                    @endforeach

                                         @if (View::exists("admin.$dataType->slug.browse-include"))
                                             @include("admin.$dataType->slug.browse-include")
                                         @endif

                                        <td>
                                            <a href="{{URL::to('admin/'.$dataType->slug.'/edit/'.$data->id)}}" class="btn-sm btn-primary pull-right edit">
                                                Правка
                                            </a>
                                            <a href="{{URL::to('admin/'.$dataType->slug.'/show/'.$data->id)}}" class="btn-sm btn-warning pull-right">
                                                Обзор
                                            </a>
                                            <a href="#" class="btn-sm btn-danger pull-right" data-toggle="modal" data-target="#{{$data->id}}">
                                                Удалить
                                            </a>

                                            <div id="{{$data->id}}" class="modal fade">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button class="close" type="button" data-dismiss="modal">×</button>
                                                            <h4 class="modal-title">Удаление записи</h4>
                                                        </div>
                                                        <div class="modal-body">Вы действительно хотите удалить запись?</div>
                                                        <div class="modal-footer">

                                                            <form action="{{url('admin/'.$dataType->slug.'/delete/'.$data->id)}} " method="POST">
                                                                {{ method_field("DELETE") }}
                                                                {{ csrf_field() }}
                                                                <input type="submit" class="btn btn-danger delete-confirm"
                                                                       value="Удалить {{ $dataType->display_name_singular }}">
                                                                <button class="btn btn-default pull-right" type="button" data-dismiss="modal">Закрыть</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php $model = "App\\".$dataType->model_name ?>
                <?php
                $selectUser = ($selectUser == 0) ? 10 : $selectUser; //count records on page
                $startRange = ($dataTypeContent->currentPage() == 1) ? 1 : (($dataTypeContent->currentPage() - 1) * $selectUser) + 1;
                $endRange   = $dataTypeContent->count() + $startRange -1;
                //$endRange   = ($endRange > $dataTypeContent->count()) ? $dataTypeContent->count() : $endRange;
                ?>
                Показано {{$startRange}} - {{ $endRange }} записей из {{$model::all()->count()}}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                {{ $dataTypeContent->appends(['paginate' => $selectUser])->links() }}
            </div>
        </div>
    </div>
@stop


