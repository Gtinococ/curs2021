<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievements extends Model
{
    use HasFactory;

    protected $table = 'achievements';

    protected $fillable = [
        'id',
        'achiev_id',
        'name'
    ];
}
