<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\CategoriesArticles;
use App\CommentsArticle;
use Carbon\Carbon;
use App\Pages;
use App\MenuItem;
use App\Settings;
use phpDocumentor\Reflection\Types\Null_;
use SebastianBergmann\Comparator\ArrayComparator;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this -> menuItems = MenuItem::where('menu_id' , Settings::first()->user_top_menu)
            ->orderBy('order')
            ->get();
    }

    private function getPage(Request $request){
        $page = Pages::findSlug($request->segment(1));
        if(empty($page)){
            $page = Pages::find(Settings::first()->default_page_header);
        }
        return $page;
    }

    public function articles(Request $request){
        $page = $this->getPage($request);
        if(!empty($request->get('find'))){
            $articles = Article::findByStatus('PUBLISHED')
                ->where('title', 'like', '%'.$request->get('find').'%')
                ->orWhere('body', 'like', '%'.$request->get('find').'%')
                ->orderBy('id', 'desc')
                ->paginate(5);
        }else{
            $articles = Article::findByStatus('PUBLISHED')->orderBy('id', 'desc')->paginate(5);
        }
        $commentsArticle = DB::table('commentsArticle')
            ->select('article_id')
            ->groupBy('article_id')
            ->orderBy(DB::raw('count(*)'), 'desc')
            ->limit(5)
            ->get();
        $commentsArticle = json_decode($commentsArticle, true);

        foreach ($commentsArticle as $value) {
            $article = Article::find($value['article_id']);
            $popularArticle []= [
                'title' => $article->title,
                'image' => $article->image,
                'slug'  => $article->slug
            ];
        }

        $categoriesArticles = CategoriesArticles::getActiveCategories();

        return view('articles',[
            'articles'           => $articles,
            'popularArticle'     => $popularArticle,
            'categoriesArticles' => $categoriesArticles,
            'page'               => $page,
            'menuItems'          => $this->menuItems
        ]);
    }

    public function articlesCategory(Request $request, $category_slug){

        $categoriesArticles=CategoriesArticles::getActiveCategories();
        $category = CategoriesArticles::findBySlug($category_slug);
        $articles = Article::findByStatus('PUBLISHED')
            ->where('category_id', $category->id)
            ->orderBy('id', 'desc')
            ->paginate(5);
        $page = $this->getPage($request);
        $commentsArticle = DB::table('commentsArticle')
            ->select('article_id')
            ->groupBy('article_id')
            ->orderBy(DB::raw('count(*)'), 'desc')
            ->limit(5)
            ->get();
        $commentsArticle = json_decode($commentsArticle, true);

        foreach ($commentsArticle as $value) {
            $article = Article::find($value['article_id']);
            $popularArticle []= [
                'title' => $article->title,
                'image' => $article->image,
                'slug' => $article->slug
            ];
        }
        return view('articles',[
            'articles'           =>$articles,
            'popularArticle'     => $popularArticle,
            'categoriesArticles' => $categoriesArticles,
            'page'               => $page,
            'menuItems'          => $this->menuItems,
            'category'           => $category_slug
        ]);
    }

    public function article($slug){

        $article_slug = Article::findBySlug($slug);

        if(!isset($article_slug) || $article_slug->status != "PUBLISHED"){
            return redirect('/articles');
        }

        $categoriesArticles=CategoriesArticles::getActiveCategories();
        $comments=CommentsArticle::where('public','YES')
            ->where('article_id', $article_slug->id)
            ->orderBy('order_parent', 'desc')
            ->orderBy('path', 'asc')
            ->get();
        $commentsArticle = DB::table('commentsArticle')
            ->select('article_id')
            ->groupBy('article_id')
            ->orderBy(DB::raw('count(*)'), 'desc')
            ->limit(5)
            ->get();
        $commentsArticle = json_decode($commentsArticle, true);
        foreach ($commentsArticle as $value) {
            $article = Article::find($value['article_id']);
            $popularArticle []= [
                'title' => $article->title,
                'image' => $article->image,
                'slug'  => $article->slug
            ];
        }
        return view('article',[
            'article'            => $article_slug,
            'popularArticle'     => $popularArticle,
            'categoriesArticles' => $categoriesArticles,
            'comments'           => $comments,
            'page'               => $article,
            'menuItems'          => $this->menuItems
        ]);
    }
}
