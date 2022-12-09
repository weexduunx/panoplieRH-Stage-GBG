<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Tache extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'checklist_id',
        'nom',
        'description',
        'position',
        'user_id',
        'tache_id',
        'completed_at',
        'added_to_my_day_at',
        'is_important',
        'due_date'
    ];

    protected $dates = [
        'due_date'
    ];

    public function registerAllMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368);
            // ->height(232)
            // ->sharpen(10)

    }

}

