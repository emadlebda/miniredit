<?php

namespace App\Providers;

use App\Models\Community;
use App\Models\Post;
use App\Models\PostVote;
use App\Observers\PostVoteObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (App::environment('local'))
            Schema::defaultStringLength(191);

        Paginator::useBootstrap();

        View::share('newestPosts', Post::with('community')->latest()->take(5)->get());
        View::share('newestCommunities', Community::withCount('posts')->latest()->take(5)->get());

        PostVote::observe(PostVoteObserver::class);
    }
}
