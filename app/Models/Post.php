<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'slug',
        'user_id',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];


    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * Set the slug attribute to snake_case.
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::kebab($value);
    }

    /**
     * Optionally, you can generate a slug from the title.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (!$post->slug) {
                // Generate the slug from the title and convert to snake_case
                $post->slug = Str::kebab($post->title);
            }

            // Generate excerpt if none is provided
            if (empty($post->excerpt) && !empty($post->content)) {
                preg_match('/^.*?[.?!](\s|$)/', $post->content, $matches);
                $post->excerpt = $matches[0] ?? Str::limit($post->content, 100);
            }
        });

        // static::updating(function ($post) {
        //     if ($post->isDirty('title')) {
        //         $post->slug = Str::kebab($post->title);
        //     }
        // });
    }

    public function getTitleAttribute($value)
    {
        return Str::apa($value); //Title Sase for Blog Titles
    }
}
