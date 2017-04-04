
    <div class="col-lg-3 col-md-3 col-lg-offset-1 col-md-offset-1 col-sm-3 col-sm-offset-1 hidden-xs">
        <div>
            <form method="get" action="{{ url('/articles1')}}">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Поиск" name="find">
                    <div class="input-group-btn">
                        <button class="btn btn-default search" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="list-group">
            <p class ="h4 text-center list-group-item text-success">КАТЕГОРИИ</p>
            @foreach($categoriesArticles as $categories)
                <a href="{{url('/articles/category_'.$categories->slug)}}"
                   @if(isset($category) && !empty($category) && $categories->slug == $category)
                   class= "list-group-item active_green"
                   @else
                   class= "list-group-item"
                        @endif
                >
                    {{$categories->name}}<span class="badge">{{App\Article::findByStatus('PUBLISHED')->where('category_id', $categories->id)->count()}}</span>
                </a>
            @endforeach
        </div>
        <div class="list-group">
            <p class ="h4 text-center list-group-item text-success">ПОПУЛЯРНОЕ</p>
            @foreach($popularArticle as $popular)
                <a href="{{URL::to('articles/'.$popular['slug'])}}" class ="list-group-item popular_item">
                    @if(!empty($popular['image']) && Storage::disk('public')->exists($popular['image']))
                        <img  class="img-thumbnail img_popular" src="{{Storage::disk('public')->url($popular['image'])}}" alt="{{$popular['title']}}">
                    @endif
                    {{$popular['title']}}
                </a>
            @endforeach
        </div>

    </div>
    <br>
    <br>
    <br>
    <div class=" col-lg-3 col-md-3 col-lg-offset-1 col-md-offset-1 col-sm-3 col-sm-offset-1 hidden-xs">

    </div>
    <br>
    <br>
    <br>
    <div class=" col-lg-3 col-md-3 col-lg-offset-1 col-md-offset-1 col-sm-3 col-sm-offset-1 hidden-xs">

    </div>

<!--
<div class="panel panel-default">
    <div class="panel-heading">КАТЕГОРИИ</div>
    <div class="panel-body">
        <div class="list-group">
                @foreach($categoriesArticles as $categories)
                    <a href="{{url('/articles/category_'.$categories->slug)}}"
                       @if(isset($category) && !empty($category) && $categories->slug == $category)
                            class= "list-group-item active"
                       @else
                            class= "list-group-item"
                       @endif
                    >
                        {{$categories->name}}<span class="badge">{{$categories->article->count()}}</span>
                    </a>
                @endforeach
        </div>
    </div>
</div>
-->

<!--
<div class="well">
    КАТЕГОРИИ
    @foreach($categoriesArticles as $categories)
        <a href ="{{url('/articles/category_'.$categories->slug)}}" >
            <button type="button" class="btn btn-success pull-right">{{$categories->name}}</button>
        </a>
    @endforeach
</div>

-->

