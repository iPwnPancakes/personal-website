<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\PostStates;
use Illuminate\Console\Command;

class CheckAbandonedPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:abandoned';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for posts with missing blade files. Returns 1 if there are any, 0 otherwise.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('state', PostStates::PUBLISHED)->get();

        $postsWithMissingBladeFiles = $posts
            ->filter(fn ($post) => ! view()->exists($post->blade_file))
            ->map(fn ($post) => ['ID' => $post->id, 'Title' => $post->title, 'Blade file' => $post->blade_file]);

        if (! empty($postsWithMissingBladeFiles)) {
            $this->info('The following posts have missing blade files:');
            $this->table(['ID', 'Title', 'Blade file'], $postsWithMissingBladeFiles);

            return 1;
        }

        return 0;
    }
}
