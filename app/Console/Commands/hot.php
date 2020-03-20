<?php

namespace App\Console\Commands;

use App\Http\UpdateService;
use App\Period;
//use App\PeriodManCar as Period;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class hot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '避開上期號碼';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $initMoney = 5000;


        $verify = app(Period::class)->where('period', 'like', '%20200312%')->orderBy('period')->get();

        foreach ($verify as $key => $val) {
            $win  = 0;
            $lose = 0;
            if ($key == 0) {
                $oldone   = $val->one;
                $oldtwo   = $val->two;
                $oldthree = $val->three;
                $oldfour  = $val->four;
                $oldfive  = $val->five;
                $oldsix   = $val->six;
                $oldseven = $val->seven;
                $oldeight = $val->eight;
                $oldnine  = $val->nine;
                $oldten   = $val->ten;
                continue;
            }

            if ($val->one == $oldone) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->two == $oldtwo) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->three == $oldthree) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->four == $oldfour) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->five == $oldfive) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->six == $oldsix) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->seven == $oldseven) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->eight == $oldeight) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->nine == $oldnine) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->ten == $oldten) {
                $lose += 90;
            } else {
                $win += 9;
            }
            $initMoney -= $lose;
            $initMoney += $win;
//            dd();
//            dd($initMoney);
//$this->line()
            $this->line("-------------------------------------------------------------------------------------------------------------------------------------");
            $this->line("$val->period");
            $this->line("開獎 | $val->one $val->two $val->three $val->four $val->five $val->six $val->seven $val->eight $val->nine $val->ten");
            $this->line("舊號 | $oldone $oldtwo $oldthree $oldfour $oldfive $oldsix $oldseven $oldeight $oldnine $oldten ");
            $this->line("輸：$lose , 贏：$win , 本金：" . $initMoney);

            $oldone   = $val->one;
            $oldtwo   = $val->two;
            $oldthree = $val->three;
            $oldfour  = $val->four;
            $oldfive  = $val->five;
            $oldsix   = $val->six;
            $oldseven = $val->seven;
            $oldeight = $val->eight;
            $oldnine  = $val->nine;
            $oldten   = $val->ten;
        }
    }

}
