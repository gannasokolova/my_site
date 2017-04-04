<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\UsersEvent;
use App\Observers\UserObserver;
use App\UserForAdmin;
use App\User;
use App\Observers\CommentsArticleObserver;
use App\CommentsArticle;
use App\Observers\ArticleObserver;
use App\Article;
use App\Certificate;
use App\Observers\CertificateObserver;
use App\Settings;
use App\Observers\SettingsObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\CommentsArticleUpdPublicFieldEvent' => [
            'App\Listeners\CommentsArticleListener@updatePublicField',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        UserForAdmin::observe(UserObserver::class);
        User::observe(UserObserver::class);
        CommentsArticle::observe(CommentsArticleObserver::class);
        Article::observe(ArticleObserver::class);
        Certificate::observe(CertificateObserver::class);
        Settings::observe(SettingsObserver::class);
    }
}
