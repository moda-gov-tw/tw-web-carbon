<?php

namespace App\Models;

use App\Traits\SerialTimezoneTrait;
use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
    use SerialTimezoneTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'password_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'password', 'created_at'];

    public $timestamps = false;

    public function getCreatedAtAttribute() {
        return date('d-m-Y H:i:s', strtotime($this->attributes['created_at']));
    }

}
