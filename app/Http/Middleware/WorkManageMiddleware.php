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
        $id = $request->route('id');

        if (is_numeric($id)) {
            $work = Work::findOrFail($id);
        }

        if (isset($work)) {
            if (auth()->user()->author->id == $work->author_id) {
                return $next($request);
            }
        }

        abort(404);
    }
}
