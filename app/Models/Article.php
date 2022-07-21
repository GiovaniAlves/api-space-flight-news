<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = ['id', 'title', 'url', 'imageUrl', 'newsSite', 'summary', 'publishedAt', 'updatedAt',
        'featured', 'launches', 'events'];
}
