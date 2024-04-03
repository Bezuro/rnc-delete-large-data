<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'name', 'email', 'registration_date',
    ];
}
