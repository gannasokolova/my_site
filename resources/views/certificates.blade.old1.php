@extends('templates.default')

@section('page_script')
    <link href="{{asset ('css/css/mosaic_flow.css')}}" rel="stylesheet">
@stop
@section('content')
<p></p>

<div class="mosaicflow">
    @foreach ($certificates as $certificate)
        @if(file_exists(public_path().DIRECTORY_SEPARATOR.$certificate->image))
            <div class="mosaicflow__item">
                <a data-toggle="modal" data-target=".pop-up-{{$certificate->id}}" href="#">
                <img src="{{asset($certificate->image)}}"  alt="{{$certificate->alt}}">
                </a>
            </div>

            <div class="modal fade pop-up-{{$certificate->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <img src="{{asset($certificate->image)}}" class="img-responsive center-block" alt="">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal mixer image -->

        @endif
    @endforeach


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('css/js/jquery.mosaicflow.min.js') }}"></script>


@stop