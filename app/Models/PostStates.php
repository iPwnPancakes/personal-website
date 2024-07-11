<?php

namespace App\Models;

enum PostStates: string
{
    case PUBLISHED = 'published';
    case DRAFT = 'draft';
}
