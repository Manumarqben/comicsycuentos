<?php

namespace App\Http\Middleware;

use App\Models\Work;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkManageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('slug');
        $work = Work::where('slug', $slug)->firstOrFail();
        
        if (auth()->user()->author->id !== $work->author_id) {
            abort(404);
        }

        return $next($request);
    }
}
