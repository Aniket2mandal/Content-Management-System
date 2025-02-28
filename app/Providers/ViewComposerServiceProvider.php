<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Seo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.layout.header', function ($view) {
            $categories = Category::where('Status',1)->latest()->get(); // Fetch all categories
            $pages = Page::where('Page_status',1)->get(); // Fetch all pages

            $view->with([
                'categories' => $categories,
                'pages' => $pages
            ]);
        });

        View::composer('frontend.layout.footer', function ($view) {
            $latestPosts = Post::latest()->take(3)->get();
            $seodescription=Seo::where('name','description')->first();
            $seophone=Seo::where('name','number')->first();
             // Fetch latest 3 posts
            $view->with([
                'latestPosts'=>$latestPosts,
                'seodescription'=>$seodescription,
                'seophone'=>$seophone,
        ]);
        });
    
    }
    
    }

