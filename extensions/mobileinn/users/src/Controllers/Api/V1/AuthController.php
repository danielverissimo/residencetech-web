<?php namespace Mobileinn\Users\Controllers\Api\V1;

use Illuminate\Routing\Controller as BaseController;
use Sentinel;

class AuthController extends BaseController {

	public function auth()
	{
		$key = filter_var(input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'login';

		$data = [
			$key => input('username'),
			'password' => input('password'),
		];

		if ( ! ($user = Sentinel::authenticate($data, false, false)))
		{
			return response(['message' => trans('mobileinn/users::users/errors.invalid_credentials')], 401);
		}

		Sentinel::logout();
		Sentinel::login($user);

		return response([
			'id' => $user->id,
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'email' => $user->email,
			'token' => $user->token
		]);
	}
}