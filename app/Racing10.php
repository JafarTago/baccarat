<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Racing10 extends Model
{
    protected $table = 'racing10';

    protected $fillable = [
        'period',
        'rank_1',
        'rank_2',
        'rank_3',
        'rank_4',
        'rank_5',
        'rank_6',
        'rank_7',
        'rank_8',
        'rank_9',
        'rank_10',
        'sum_12',
        'sum_bs',
        'sum_sd',
        'animal_1',
        'animal_2',
        'animal_3',
        'animal_4',
        'animal_5',
        'time',
    ];

    public $timestamps = false;
}
