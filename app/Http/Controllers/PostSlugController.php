<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostSlugController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Post $post)
    {
        return view($post->blade_file);
    }
}
