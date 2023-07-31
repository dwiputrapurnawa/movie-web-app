<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Movie extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ["id"];

    public function getRouteKeyName() {
        return "slug";
    }

    public function genre() {
        return $this->belongsToMany(Genre::class, "movie_genres");
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

    public function rating() {
        return $this->hasMany(Rating::class);
    }

    public function scopeFilter($query, $filter) {
        return $query->where("title", "like", "%" . $filter . "%")->orWhere("synopsis", "like", "%" . $filter . "%");
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
