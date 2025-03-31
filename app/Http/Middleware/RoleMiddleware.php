<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ResponseApi;
use Spatie\Permission\Exceptions\UnauthorizedException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {

            $authGuard = Auth::guard($guard);

            if ($authGuard->guest()) {
                throw UnauthorizedException::notLoggedIn();
            }

            $roles = is_array($role)
                ? $role
                : explode('|', $role);

            if (!$authGuard->user()->hasAnyRole($roles)) {
                abort(ResponseApi::statusValidateError()
                    ->error('You don\'t have role access')
                    ->message('Unauthorized')
                    ->info(["auth" => false])
                    ->json());
                //                throw UnauthorizedException::forRoles($roles);
            }

            return $next($request);
        } catch (\Exception $e) {
            abort(ResponseApi::statusValidateError()
                ->error('You don\'t have role access')
                ->message('Unauthorized')
                ->info(["auth" => false])
                ->json());
        }
    }
}
