<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class KategoriVideo extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }
}
