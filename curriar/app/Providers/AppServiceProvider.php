<?php

namespace App\Providers;


use App\Channels\EbernateChannel;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Notification;
use View;
use Blade;
class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Schema::defaultStringLength(191);
    View::composer('*', function($view){
      $view_name = explode('.',$view->getName());
      View::share('currentView', $view_name[count($view_name)-1]);
    });
    Blade::directive('includeHook', function($view) {
      return "<?php echo view(".$view.")->render(); ?>";
    });


      Notification::extend('ebernate', function ($app) {
          return new EbernateChannel();
      });

  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
