<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Genre extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $guarded = ["id"];

    public function getRouteKeyName() {
        return "slug";
    }

    public function movie() {
        return $this->belongsToMany(Movie::class, "movie_genres");
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
