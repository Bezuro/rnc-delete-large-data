<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Csvdata extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'csvdata';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];
}
