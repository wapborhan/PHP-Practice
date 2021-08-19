<?php
namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Http\Helpers\SpotConfigHelper;
class RouteServiceProvider extends ServiceProvider
{
  /**
   * This namespace is applied to your controller routes.
   *
   * In addition, it is set as the URL generator's root namespace.
   *
   * @var string
   */
  protected $namespace = 'App\Http\Controllers';

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @return void
   */
  public function boot()
  {
    //

    parent::boot();
  }

  /**
   * Define the routes for the application.
   *
   * @return void
   */
  public function map()
  {

    $this->mapAdminRoutes();

    if(SpotConfigHelper::getValue('installable') == "true")
    {
      $this->mapInstallRoutes();
    }
    elseif(SpotConfigHelper::getValue('updatable') == "true")
    {
      $this->mapUpdateRoutes();
    }
    else
    {
      
    $this->mapApiRoutes();

    $this->mapOtpRoutes();

    $this->mapWebRoutes();

    $this->mapAddonsRoutes();

    }
  }
  /**
   * Define the "Addons System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapAddonsRoutes()
  {
    $dir = $files = \File::files(base_path('routes/addons'));
    foreach ($dir as $fileinfo) {
          Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/addons/'.$fileinfo->getFilename()));
    }

    $dir = $files = \File::files(base_path('routes/addons/api'));
    foreach ($dir as $fileinfo) {
          Route::middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/addons/api/'.$fileinfo->getFilename()));
    }
  }
  /**
   * Define the "OTP System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapOtpRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/otp.php'));
  }

  /**
   * Define the "updating" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapUpdateRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/update.php'));
  }

  /**
   * Define the "installation" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapInstallRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/install.php'));
  }

  /**
   * Define the "web" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/web.php'));
  }

  /**
   * Define the "admin" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapAdminRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/admin.php'));
  }

  /**
   * Define the "api" routes for the application.
   *
   * These routes are typically stateless.
   *
   * @return void
   */
  protected function mapApiRoutes()
  {
    Route::prefix('api')
       ->middleware('api')
       ->namespace($this->namespace)
       ->group(base_path('routes/api.php'));
  }
}
