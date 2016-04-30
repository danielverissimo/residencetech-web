<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	protected $csrfWhitelist = [
		'admin/api/v1/auth'
	];

	protected $except_urls = [
        'admin/api/v1/ocurrences/*',
    ];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$regex = '#' . implode('|', $this->except_urls) . '#';

		if (in_array($request->path(), $this->csrfWhitelist) || preg_match($regex, $request->path()) ) {
			return $next($request);
		}

		return parent::handle($request, $next);
	}

}
