<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Web extends Model
{
    protected $table = 'web';

    protected $fillable = [
        'my_ip',
        'url',
        'type',
        'content',
        'updated_at',
        'my_uuid',
    ];

    protected $casts = [
        'content' => 'json'
    ];

    public function getCreatedAtAttribute() {
        return date('d-m-Y H:i', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute() {
        return date('d-m-Y H:i', strtotime($this->attributes['updated_at']));
    }
}
