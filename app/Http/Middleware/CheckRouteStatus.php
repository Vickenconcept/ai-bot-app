<?php

namespace App\Http\Middleware;

use App\Models\Conversation;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckRouteStatus  
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $route = Route::current();

        // $routeName = $route->getName(); // Get route name
        $routeParams = $route->parameters();

        $routeStatus = Conversation::where('uuid', $routeParams)->first();

        if ($routeStatus  != null) {
            # code...
            if ($routeStatus->enabled) {
                return $next($request); // At least one conversation has enabled = 1, proceed
            }
            return response()->view('errors.404', [], 404);
        }

        // dd('hello');
        return $next($request);
        
        // return response('Widget Disabled.', 403);
        
    }
}
