<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class XDay
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $todaysDate = new Carbon();
        $days = trans('app.days');
        $dayOfWeek = $days[$todaysDate->dayOfWeek];

        $response->header('X-Day', $dayOfWeek);

        return $response;
    }
}
