<?php

namespace Photogabble\Portcullis\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckRegistrationAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws HttpException
     */
    public function handle($request, Closure $next)
    {
        if (registration()->isOpen() === false) {
            throw new HttpException(403, 'Registration is closed');
        }

        return $next($request);
    }
}