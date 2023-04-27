<?php

namespace App\Http\Middleware;

use App\Models\Work;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ChapterManageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $slug = $request->route('workSlug');
        $work = Work::where('slug', $slug)->firstOrFail();
        
        if (auth()->user()->author->id !== $work->author_id) {
            abort(404);
        }

        return $next($request);
    }
}
