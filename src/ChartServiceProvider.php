<?php

namespace WI\Chart;


use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class ChartServiceProvider extends ServiceProvider
{
    
	
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    #protected $defer = true;
	
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

	    if (is_dir(base_path() . '/resources/views/admin/chart')) {
		    //load from resource
		    $this->loadViewsFrom(base_path() . '/resources/views/admin/chart', 'chart');
	    } else {
		    //load from package
		    $this->loadViewsFrom(__DIR__.'/views', 'chart');
	    }

		if (!$this->app->routesAreCached()) {
			$this->setupRoutes($this->app->router);
		}

		config([
			'config/wi/chart.php',
		]);


	    $this->publishes([
		    __DIR__.'/views' => base_path('resources/views/admin/chart'),
		    __DIR__.'/config/chart.php' => config_path('wi/chart.php')
	    ],'chart');
    }
	
	/**
		 * Define the routes for the application.
		 *
		 * @param  \Illuminate\Routing\Router  $router
		 * @return void
		 */
		public function setupRoutes(Router $router)
		{

			$router->group([
				//'namespace' => 'WI\Chart',
				'namespace' => 'WI\Chart',	// Controllers Within The "WI\Chart" Namespace
				'as' => 'admin::',		// Route named "admin::
				//'prefix' => 'backStage',	// Matches The "/admin" URL
				'prefix' => config('wi.dashboard.admin_prefix'),
				'middleware' => ['web','auth','role:beheerder']	// Use Auth Middleware
			],
				function($router)
				{
					require __DIR__.'/routes.php';
				}
			);

		}

    /**
     * Register the application services.
     * https://laracasts.com/discuss/channels/general-discussion/how-to-move-my-controllers-into-a-seperate-package-folder
     * @return void
     */
    public function register()
    {
        #dd('asdf');
		#include __DIR__.'/routes.php';
		$this->app->make('WI\Chart\ChartController');

		//$this->app->register(Vendor\Package\Providers\RouteServiceProvider::class);
    }
}
