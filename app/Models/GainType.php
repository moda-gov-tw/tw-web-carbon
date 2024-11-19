<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GainType extends Model
{
    protected $table = 'gain_type';

    protected $fillable = [
        'name',
    ];

    public function getCreatedAtAttribute() {
        return date('d-m-Y H:i', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute() {
        return date('d-m-Y H:i', strtotime($this->attributes['updated_at']));
    }
}
