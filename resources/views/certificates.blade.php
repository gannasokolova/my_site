@extends('templates.default')
@section('page_script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset ('css/js/cloud-carousel.1.0.5.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            // This initialises carousels on the container elements specified, in this case, carousel1.
            $("#carousel1").CloudCarousel(
                {
                    xPos: $("#carousel1").width()/2,
                    yPos: $("#carousel1").height()/4,
                    buttonLeft: $("#left-but"),
                    buttonRight: $("#right-but")
                }
            );
        });

    </script>
@stop
@section('content')
<div class="container-fluid">

    <div id = "carousel1" class ="col-lg-12  col-md-12 col-sm-12  col-xs-12">
        <div class="row">
            <div class ="col-lg-2  col-lg-offset-1 col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1 col-xs-3  ">
                <a href="#" id = "right-but" class ="btn btn-default"><i class="glyphicon glyphicon-arrow-left"></i></a>

            </div>
            <div class ="col-lg-5  col-md-5 col-sm-5  col-xs-6 text-center">
                <p class="h2 hidden-xs"> СЕРТИФИКАТЫ</p>
                <p class="hidden-lg hidden-sm hidden-md">СЕРТИФИКАТЫ</p>
            </div>
            <div class ="col-lg-2  col-md-2 col-sm-2 col-xs-3 ">
                <a href="#" id = "left-but" class ="btn btn-default"><i class="glyphicon glyphicon-arrow-right"></i></a>

            </div>
        </div>
        @foreach ($certificates as $certificate)
        @if(file_exists(public_path().DIRECTORY_SEPARATOR.$certificate->image))
            <a data-toggle="modal" data-target=".pop-up-{{$certificate->id}}" href="#">
                <img  class="cloudcarousel " src="{{asset($certificate->image)}}" alt="{{$certificate->alt}}">
            </a>

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
    </div>


</div>
@stop