<?php /** @noinspection PhpSignatureMismatchDuringInheritanceInspection */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if ($request->user('users')->type == $role[0]) {
            return $next($request);
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        return route('home');
    }
}
