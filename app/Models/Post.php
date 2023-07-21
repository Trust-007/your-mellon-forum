<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    
    public function user() {
        return $this->belongsTo(User::class);  
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    protected $fillable = ['title', 'text', 'creation_date', 'user_id'];

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
           $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('text', 'like', '%' . request('search') . '%')
            ->orWhere('creation_date', 'like', '%' . request('search') . '%');
        }
    }
    
}
