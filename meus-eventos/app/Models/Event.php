<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Event extends Model
{
    use HasFactory, HasSlug;

    /* Verificar se user_id e obrigatorio neste array */
    protected $fillable = ['banner', 'title', 'description', 'body', 'slug', 'start_event'];
    protected $dates = ['start_event'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Relations
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrolleds()
    {
        return $this->belongsToMany(User::class)->withPivot('reference', 'status');
    }

    /**
     * Our Methods
     */
    public function getEventsHome($byCategory = null)
    {
        $events = $byCategory ? $byCategory : $this->orderBy('start_event', 'DESC');

        $events->when(
            $search = request()->query('s'),
            function ($queryBuilder) use ($search) {
                return $queryBuilder->where('title', 'LIKE', '%' . $search . '%');
            }
        );

        //$events->whereRaw('DATE(start_event) >= DATE(NOW())');
        $events->whereDate('start_event', '>=', now());

        return $events;
    }


}
