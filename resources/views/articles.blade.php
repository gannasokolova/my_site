@extends('templates.default')

@section('content')
  <div class="row article_row">
      <div class=" col-lg-7 col-lg-offset-1 col-md-7  col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
@if($articles->count() == 0)
    <p class="h2 text-center"> К сожалению по Вашему запросу ничего не найдно</p>
    @endif
      <?php $count = 0;?>
          @foreach($articles as $key => $article)
              @if($count < 1 )
                  <div class="row article_row ">
                      <div class="hidden-lg hidden-md hidden-sm col-xs-10 col-xs-offset-1">
                          <form method="get" action="{{ url('/articles1')}}">
                              <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Поиск" name="find">
                                  <div class="input-group-btn">
                                      <button class="btn btn-default search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                  </div>
                              </div>
                          </form>
                      </div>

                      <div class="hidden-lg hidden-md hidden-sm col-xs-10 col-xs-offset-1">
                          <div class="list-group">
                              <a class ="h4 list-group-item btn active_green" id = "category">КАТЕГОРИИ
                                  <i class="glyphicon  glyphicon-plus pull-right"> </i></a>
                          @foreach($categoriesArticles as $categories)
                              <a href="{{url('/articles/category_'.$categories->slug)}}"
                                 @if(isset($category) && !empty($category) && $categories->slug == $category)
                                 class= "list-group-item active_green hidden category_item"
                                 @else
                                 class= "list-group-item hidden category_item"
                                      @endif
                              >
                                  {{$categories->name}}<span class="badge">{{App\Article::findByStatus('PUBLISHED')->where('category_id', $categories->id)->count()}}</span>
                              </a>
                          @endforeach
                          </div>
                      </div>
                  </div>
              @endif
          <div class="row article_row ">
                     <article class=" white_color col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="row article_row">
                              <div>
                                  <h2 class = "text-center text-success">{{$article->title}}</h2>
                              </div>
                          </div>
                          <hr>
                          <div class="row article_row">
                              <div>
                                  <i class="icon_green glyphicon glyphicon-calendar"></i> {{$article->created_at->format('d.m.y H:i:s')}}
                                  | <i class="icon_green glyphicon glyphicon-comment"></i>
                                  @if($article->comments->count() > 0)
                                      {{$article->comments->count()}} Комментариев
                                  @else
                                      Комментарии отсутствуют
                                  @endif
                              </div>
                          </div>
                          <div class="row article_row">
                              <div>
                                  @if(!empty($article->image) && Storage::disk('public')->exists($article->image))
                                      <img  class="img-thumbnail article_img" src="{{Storage::disk('public')->url($article->image)}}" alt="{{$article->title}}">
                                  @endif
                                  {!!str_limit($article->body, $limit = 750, $end = ' [...]')!!}
                              </div>
                          </div>
                          <div class="row article_row">
                              <div class="col-lg-offset-9 col-sm-offset-9 col-md-offset-9 col-xs-offset-4 ">
                                  <a href ="{{url('/articles/'.$article->slug)}}" class="btn btn-default read-more" >
                                      Читать далее... <i class="glyphicon glyphicon-chevron-right icon_green"></i>
                                  </a>
                              </div>
                          </div>
                          <div class="row article_row">
                              <div>
                                  <hr>
                              </div>
                          </div>
                      </article>
          </div>
                  <?php $count++; ?>


              @endforeach
      </div>
              @include('templates.groupArticles')
  </div>



    <div class=" col-lg-7 col-md-7 col-lg-offset-1 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 text-center">

            {{$articles->links('templates.pagination')}}

    </div>

    <script>
        $( document ).ready(function() {
            $( "#category" ).click(function() {
                $( ".category_item" ).each(function() {
                   if($( this ).hasClass('hidden')) {
                       $(this).removeClass('hidden');
                   }else{
                       $(this).addClass('hidden');
                   }
                });
            });
        });
    </script>


@stop