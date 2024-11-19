<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Home extends Model implements Viewable
{
    use InteractsWithViews;
    
    protected $table = 'home';

    protected $fillable = [
        'gain_type_id',
        'title',
        'detail',
        'gain_date',
        'gain_folder',
        'gain_file',
    ];

    public function getCreatedAtAttribute() {
        return date('d-m-Y H:i', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute() {
        return date('d-m-Y H:i', strtotime($this->attributes['updated_at']));
    }
}
