<?php namespace App\Http\Middleware;

use Closure;
use Sentinel;
use Illuminate\Http\JsonResponse;

class VerifyToken {
    public function handle($request, Closure $next)
    {
        $userRepository = app('Platform\Users\Repositories\UserRepositoryInterface');

        $token = $request->header('token') ?: $request->input('token');

        if ($request->path() === 'admin/api/v1/auth') return;

        if ( ! ($user = $userRepository->findByToken($token)))
        {
            return new JsonResponse('Authorization required!', 401);
        }

        Sentinel::setUser($user);

        return $next($request);
    }
}