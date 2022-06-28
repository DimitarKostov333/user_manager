<?php

namespace App\Http\Middleware;

use Closure;

class XssSanitizer
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
        // Get all input
        $input = $request->all();

        // Strip tags from input string
        array_walk_recursive($input, function(&$input) {
            $input = strip_tags($input);
        });

        // Concatenate string
        $request->merge($input);

        return $next($request);
    }
}
