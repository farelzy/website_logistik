<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'image',
        'category', 'user_id', 'is_published', 'published_at', 'views',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->where('published_at', '<=', now())
                     ->latest('published_at');
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
