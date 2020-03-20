<?php

namespace App\Console\Commands;

use App\Http\UpdateService;
use App\Period;
//use App\PeriodManCar as Period;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class cold extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '固定號';

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
//        $this->line(app(UpdateService::class)->updateLottery());

//        $designatedNumber = $this->ask('請輸入指定號碼');

//        if (is_null($designatedNumber)) {
//            $designatedNumber = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
//            $designatedNumber = array_rand($designatedNumber, 7);
//        } else {
//            $designatedNumber = explode(',', $designatedNumber);
//        }
//
//        $number17 = [1, 2, 3, 4, 5, 6, 7];
//        $number28 = [2, 3, 4, 5, 6, 7, 8];
//        $number39 = [3, 4, 5, 6, 7, 8, 9];
//        $number40 = [4, 5, 6, 7, 8, 9, 0];
//        $number51 = [5, 6, 7, 8, 9, 0, 1];
//        $number62 = [6, 7, 8, 9, 0, 1, 2];
//        $number73 = [7, 8, 9, 0, 1, 2, 3];
//        $number84 = [8, 9, 0, 1, 2, 3, 4];
//        $number95 = [9, 0, 1, 2, 3, 4, 5];
//        $number06 = [0, 1, 2, 3, 4, 5, 6];

        $initMoney = 5000;


        $verify = app(Period::class)->where('period', 'like', '%20200312%')->orderBy('period')->get();

        $limit = 23;
        foreach ($verify as $key => $val) {
            $win  = 0;
            $lose = 0;
            if ($key <= $limit) {
                continue;
            }

            $number['one']   = [];
            $number['two']   = [];
            $number['three'] = [];
            $number['four']  = [];
            $number['five']  = [];
            $number['six']   = [];
            $number['seven'] = [];
            $number['eight'] = [];
            $number['nine']  = [];
            $number['ten']   = [];

            $datas = app(Period::class)->where('period', 'like', '%20200312%')->offset($key - $limit - 1)->limit($limit+1)->orderBy('period')->get()->toArray();
            asort($datas);
//            dd($datas);
            foreach ($datas as $data) {

//                $this->line($data['period']);

                if (count($number['one']) < 9) {
                    $number['one'][$data['one']] = 1;
                }
                if (count($number['two']) < 9) {
                    $number['two'][$data['two']] = 1;
                }
                if (count($number['three']) < 9) {
                    $number['three'][$data['three']] = 1;
                }
                if (count($number['four']) < 9) {
                    $number['four'][$data['four']] = 1;
                }
                if (count($number['five']) < 9) {
                    $number['five'][$data['five']] = 1;
                }
                if (count($number['six']) < 9) {
                    $number['six'][$data['six']] = 1;
                }
                if (count($number['seven']) < 9) {
                    $number['seven'][$data['seven']] = 1;
                }
                if (count($number['eight']) < 9) {
                    $number['eight'][$data['eight']] = 1;
                }
                if (count($number['nine']) < 9) {
                    $number['nine'][$data['nine']] = 1;
                }
                if (count($number['ten']) < 9) {
                    $number['ten'][$data['ten']] = 1;
                }
            }
            ksort($number['one']);
            ksort($number['two']);
            ksort($number['three']);
            ksort($number['four']);
            ksort($number['five']);
            ksort($number['six']);
            ksort($number['seven']);
            ksort($number['eight']);
            ksort($number['nine']);
            ksort($number['ten']);

            for ($i = 0; $i <= 9; $i++) {
                if (! isset($number['one'][$i])) {
                    $number['one']['cold'] = $i;
                }
                if (! isset($number['two'][$i])) {
                    $number['two']['cold'] = $i;
                }
                if (! isset($number['three'][$i])) {
                    $number['three']['cold'] = $i;
                }
                if (! isset($number['four'][$i])) {
                    $number['four']['cold'] = $i;
                }
                if (! isset($number['five'][$i])) {
                    $number['five']['cold'] = $i;
                }
                if (! isset($number['six'][$i])) {
                    $number['six']['cold'] = $i;
                }
                if (! isset($number['seven'][$i])) {
                    $number['seven']['cold'] = $i;
                }
                if (! isset($number['eight'][$i])) {
                    $number['eight']['cold'] = $i;
                }
                if (! isset($number['nine'][$i])) {
                    $number['nine']['cold'] = $i;
                }
                if (! isset($number['ten'][$i])) {
                    $number['ten']['cold'] = $i;
                }
            }

//            dd($number);
            $coldNumber[1]  = $number['one']['cold'];
            $coldNumber[2]  = $number['two']['cold'];
            $coldNumber[3]  = $number['three']['cold'];
            $coldNumber[4]  = $number['four']['cold'];
            $coldNumber[5]  = $number['five']['cold'];
            $coldNumber[6]  = $number['six']['cold'];
            $coldNumber[7]  = $number['seven']['cold'];
            $coldNumber[8]  = $number['eight']['cold'];
            $coldNumber[9]  = $number['nine']['cold'];
            $coldNumber[10] = $number['ten']['cold'];
//            dd($number['ten']);

            if ($val->one == $coldNumber[1]) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->two == $coldNumber[2]) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->three == $coldNumber[3]) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->four == $coldNumber[4]) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->five == $coldNumber[5]) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->six == $coldNumber[6]) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->seven == $coldNumber[7]) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->eight == $coldNumber[8]) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->nine == $coldNumber[9]) {
                $lose += 90;
            } else {
                $win += 9;
            }

            if ($val->ten == $coldNumber[10]) {
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
            $this->line("冷號 | $coldNumber[1] $coldNumber[2] $coldNumber[3] $coldNumber[4] $coldNumber[5] $coldNumber[6] $coldNumber[7] $coldNumber[8] $coldNumber[9] $coldNumber[10]");
            $this->line("輸：$lose , 贏：$win , 本金：" . $initMoney);

        }
    }

}
