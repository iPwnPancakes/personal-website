<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasSlug;

    protected $fillable = ['title', 'blade_file', 'state', 'slug'];

    protected $casts = [
        'state' => PostStates::class
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)
            ->skipGenerateWhen(fn() => $this->state === 'draft')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function isDraft(): bool
    {
        return $this->state === PostStates::DRAFT;
    }

    public function isPublished(): bool
    {
        return $this->state === PostStates::PUBLISHED;
    }
}
