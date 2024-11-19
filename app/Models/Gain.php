<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;

class Gain extends Model implements Viewable
{
    use InteractsWithViews;

    protected $table = 'gain';

    protected $fillable = [
        'gain_type_id',
        'title',
        'detail',
        'gain_date',
        'gain_folder',
        'gain_file',
    ];

    public function getCreatedAtAttribute()
    {
        return date('d-m-Y H:i', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute()
    {
        return date('d-m-Y H:i', strtotime($this->attributes['updated_at']));
    }
}
