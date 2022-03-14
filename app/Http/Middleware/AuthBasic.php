<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class AuthBasic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        try {
            Auth::onceBasic();
        } catch (UnauthorizedHttpException $e) {
            return response()->json(
                ["message" => 'Unauthenticated'],
                401
            );
        } catch (Exception $e) {
            return response()->json(
                ["message" => 'Authentication failed'],
                500
            );
        }
        return $next($request);
    }
}
