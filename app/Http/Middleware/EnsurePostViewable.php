<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePostViewable
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = $this->getPost($request);

        if ($post->isPublished()) {
            return $next($request);
        }

        $secret = config('posts.drafts_secret');
        if (empty($secret)) {
            abort(404);
        }

        $userInputSecret = $request->get('secret');
        if ($userInputSecret !== $secret) {
            abort(404);
        }

        return $next($request);
    }

    private function getPost(Request $request): Post
    {
        return $request->post;
    }
}
