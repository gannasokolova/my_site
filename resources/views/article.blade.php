@extends('templates.default')
@section('page_script')
    <script type="text/javascript" src="{{ asset('css/js/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            language:"ru"
        });
    </script>
@stop
@section('content')
    <div class="row">
        <div class=" col-lg-7 col-lg-offset-1 col-md-7  col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
            <div class=" white_color col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="text-center">
                    <h1 class="text-success">{{$article->title}}</h1>
                </div>
                <!-- Author -->
                <p class="lead">
                <i class="glyphicon glyphicon-time"></i> Опубликовано: {{$article->created_at->format('d.m.y H:i:s')}}
                </p>


                @if(!empty($article->image) && Storage::disk('public')->exists($article->image))
                <img  class="img-thumbnail article_img" src="{{Storage::disk('public')->url($article->image)}}" alt="{{$article->title}}">
                @endif

                {!! $article->body !!}

            </div>
        </div>

            @include('templates/groupArticles')


    </div>
<div class="row">
    <div class="col-lg-7 col-md-7 col-lg-offset-1 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
        @include('articleComments')
    </div>
</div>

 
    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center small">
                <hr> COPYRIGHT &copy; 2017 УКРПСИХОЛОГ
            </div>
        </div>
        <!-- /.row -->
    </footer>


@stop