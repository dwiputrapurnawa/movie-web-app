<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

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

    public function scopeMostPopular($query, $filter) {
        return $query->where("rating", ">=", $filter);
    }

    public function scopeFilter($query, $filter) {
        return $query->where("title", "like", "%" . $filter . "%")->orWhere("synopsis", "like", "%" . $filter . "%");
    }
}
