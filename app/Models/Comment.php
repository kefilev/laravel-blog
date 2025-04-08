<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'body',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // A comment may have many child comments
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // A comment may belong to a parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    //Scopes
    public function scopeApproved($query)
{
    return $query->where('is_approved', true);
}

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    //Functions
    public function approve()
    {
        $this->update([
            'is_approved' => true
        ]);
    }
}
