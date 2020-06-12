<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Blog extends Model
{

    use Sluggable, SoftDeletes;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->created_by && Auth::user()) {
            $this->created_by = Auth::user()->id;
        }

        parent::save();
    }

    public function userDetails()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function kategoriDetails()
    {
        return $this->belongsTo('App\Models\BlogCategory', 'kategori_id');
    }
}
