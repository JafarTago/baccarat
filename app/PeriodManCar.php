<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodManCar extends Model
{
    protected $table = 'period_man_car';

    protected $fillable = ['period', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'];

    public $timestamps = false;
}
