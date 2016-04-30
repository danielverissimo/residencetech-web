<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'App\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => 'App\Http\Middleware\Authenticate',
		'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' => 'App\Http\Middleware\RedirectIfAuthenticated',
		'verifyToken' => 'App\Http\Middleware\VerifyToken',

	];

	/**
	 * Temporary store for disabled middleware.
	 *
	 * @var array
	 */
	protected $disabledMiddleware = [];

	/**
	 * Temporary store for disabled route middleware.
	 *
	 * @var array
	 */
	protected $disabledRouteMiddleware = [];

	/**
	 * Disable middleware.
	 *
	 * @return void
	 */
	public function disableMiddleware()
	{
		$this->disabledMiddleware = $this->middleware;

		$this->middleware = [];
	}

	/**
	 * Enable middleware.
	 *
	 * @return void
	 */
	public function enableMiddleware()
	{
		$this->middleware = $this->disableMiddleware;

		$this->disabledMiddleware = [];
	}

	/**
	 * Disable route middleware.
	 *
	 * @return void
	 */
	public function disableRouteMiddleware()
	{
		$this->disabledRouteMiddleware = $this->routeMiddleware;

		$this->routeMiddleware = [];
	}

	/**
	 * Enable route middleware.
	 *
	 * @return void
	 */
	public function enableRouteMiddleware()
	{
		$this->routeMiddleware = $this->disableRouteMiddleware;

		$this->disabledRouteMiddleware = [];
	}

}
