<?php

namespace App\Console\Commands;

use App\Http\UpdateService;
use App\Period;
//use App\PeriodManCar as Period;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class ojo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'o {dataOfNumber?}';

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
        $this->line(app(UpdateService::class)->updateLottery());

        $designatedNumber = $this->ask('請輸入指定號碼');

        if (is_null($designatedNumber)) {
            $designatedNumber = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            $designatedNumber = array_rand($designatedNumber, 7);
        } else {
            $designatedNumber = explode(',', $designatedNumber);
        }

        $number17 = [1, 2, 3, 4, 5, 6, 7];
        $number28 = [2, 3, 4, 5, 6, 7, 8];
        $number39 = [3, 4, 5, 6, 7, 8, 9];
        $number40 = [4, 5, 6, 7, 8, 9, 0];
        $number51 = [5, 6, 7, 8, 9, 0, 1];
        $number62 = [6, 7, 8, 9, 0, 1, 2];
        $number73 = [7, 8, 9, 0, 1, 2, 3];
        $number84 = [8, 9, 0, 1, 2, 3, 4];
        $number95 = [9, 0, 1, 2, 3, 4, 5];
        $number06 = [0, 1, 2, 3, 4, 5, 6];

        $getDataNumber = is_null($this->argument('dataOfNumber')) ? 20 : $this->argument('dataOfNumber');
        $offset        = app(Period::class)->count() - $getDataNumber;
        $datas         = app(Period::class)
            ->offset($offset)->limit($getDataNumber)
//            ->where('period', 'like', '%20200312%')
            ->orderBy('period')->get()->toArray();

        $this->line('');
        foreach ($datas as $key => $data) {
            $word = $data['period'] . '  ';
            $word = $this->printNumber($data, $number17, $word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, $number28,$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, $number39,$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, $number40,$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, $number51,$word);
            $this->line($word);
        }

        $this->line('       名次   1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0');
        $this->line('                        1 ~ 7                               2 ~ 8                               3 ~ 9                               4 ~ 0                               5 ~ 1');
        $this->line('');
        foreach ($datas as $key => $data) {
            $word = $data['period'] . '  ';
            $word = $this->printNumber($data, $number62, $word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, $number73,$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, $number84,$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, $number95,$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, $number06,$word);
            $this->line($word);
        }

        $this->line('       名次   1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0');
        $this->line('                        6 ~ 2                               7 ~ 3                               8 ~ 4                               9 ~ 5                               0 ~ 6');
        $this->line('');

        foreach ($datas as $key => $data) {

            $word = $data['period'] . '   ';
            $word = $this->printNumber($data, $designatedNumber, $word);
            $word = $this->compartment($word);

            // 大小單雙
            if ($key == 0) {  // 紀錄上一期的數字，用來判斷下一期是否在規則內
                $previousNumber[1] = $data['one'];
                $previousNumber[2] = $data['two'];
                $previousNumber[3] = $data['three'];
                $previousNumber[4] = $data['four'];
                $previousNumber[5] = $data['five'];
                $previousNumber[6] = $data['six'];
                $previousNumber[7] = $data['seven'];
                $previousNumber[8] = $data['eight'];
                $previousNumber[9] = $data['nine'];
                $previousNumber[0] = $data['ten'];
            }
            $word .= $this->bssd($data['one'], $previousNumber[1]);
            $word .= $this->bssd($data['two'], $previousNumber[2]);
            $word .= $this->bssd($data['three'], $previousNumber[3]);
            $word .= $this->bssd($data['four'], $previousNumber[4]);
            $word .= $this->bssd($data['five'], $previousNumber[5]);
            $word .= $this->bssd($data['six'], $previousNumber[6]);
            $word .= $this->bssd($data['seven'], $previousNumber[7]);
            $word .= $this->bssd($data['eight'], $previousNumber[8]);
            $word .= $this->bssd($data['nine'], $previousNumber[9]);
            $word .= $this->bssd($data['ten'], $previousNumber[0]);

            $previousNumber[1] = $data['one'];
            $previousNumber[2] = $data['two'];
            $previousNumber[3] = $data['three'];
            $previousNumber[4] = $data['four'];
            $previousNumber[5] = $data['five'];
            $previousNumber[6] = $data['six'];
            $previousNumber[7] = $data['seven'];
            $previousNumber[8] = $data['eight'];
            $previousNumber[9] = $data['nine'];
            $previousNumber[0] = $data['ten'];

            $group[1][$data['one']]   = $data['one'];
            $group[2][$data['two']]   = $data['two'];
            $group[3][$data['three']] = $data['three'];
            $group[4][$data['four']]  = $data['four'];
            $group[5][$data['five']]  = $data['five'];
            $group[6][$data['six']]   = $data['six'];
            $group[7][$data['seven']] = $data['seven'];
            $group[8][$data['eight']] = $data['eight'];
            $group[9][$data['nine']]  = $data['nine'];
            $group[10][$data['ten']]  = $data['ten'];

            $this->line($word);
        }
        foreach ($group as $key => $g) {
            ksort($group[$key]);
        }

        $this->line('       名次    1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0');
        $this->line('                      '.implode(",", $designatedNumber).'                          大小單雙');

        $this->line("\n近 $getDataNumber 期熱碼整理");
        $this->line('流水號：1 2 3 4 5 6 7');
        $this->line($this->hotNumber($group[1], '第一名'));
        $this->line($this->hotNumber($group[2], '第二名'));
        $this->line($this->hotNumber($group[3], '第三名'));
        $this->line($this->hotNumber($group[4], '第四名'));
        $this->line($this->hotNumber($group[5], '第五名'));
        $this->line($this->hotNumber($group[6], '第六名'));
        $this->line($this->hotNumber($group[7], '第七名'));
        $this->line($this->hotNumber($group[8], '第八名'));
        $this->line($this->hotNumber($group[9], '第九名'));
        $this->line($this->hotNumber($group[10], '第十名'));
    }

    public function printNumber($data, $targetNumbers, $word)
    {
        foreach ($data as $okey => $number) {

            if ($okey == 'id' || $okey == 'period' || $okey == 'schedule_time') {  //這三個欄位不要判斷，和中獎無關係
                continue;
            }

            if (in_array($number, $targetNumbers)) {
                $word .= '<fg=red;bg=yellow> ' . $number . ' </>';
            } else {
                $word .= ' ' . $number . ' ';
            }
        }

        return $word;
    }

    public function hotNumber($data, $rank)
    {
        $word = $rank . '：';
        foreach ($data as $key => $v) {
            $word .= "$v,";
        }

        $word = substr($word, 0, -1); // 最後一個逗點移除

        return $word;
    }


    /**
     * 大小單雙判斷
     */
    public function bssd($targetNumber, $previousNumber)
    {
        switch ($previousNumber) {
            case 1:
                return in_array($targetNumber, [1, 2, 3, 4, 5, 7, 9]) ? "<fg=red;bg=yellow> $targetNumber </>" : " $targetNumber ";
            case 2:
                return in_array($targetNumber, [1, 2, 3, 4, 5, 6, 8, 0]) ? "<fg=red;bg=yellow> $targetNumber </>" : " $targetNumber ";
            case 3:
                return in_array($targetNumber, [1, 2, 3, 4, 5, 7, 9]) ? "<fg=red;bg=yellow> $targetNumber </>" : " $targetNumber ";
            case 4:
                return in_array($targetNumber, [1, 2, 3, 4, 5, 6, 8, 0]) ? "<fg=red;bg=yellow> $targetNumber </>" : " $targetNumber ";
            case 5:
                return in_array($targetNumber, [1, 2, 3, 4, 5, 7, 9]) ? "<fg=red;bg=yellow> $targetNumber </>" : " $targetNumber ";
            case 6:
                return in_array($targetNumber, [2, 4, 6, 7, 8, 9, 0]) ? "<fg=red;bg=yellow> $targetNumber </>" : " $targetNumber ";
            case 7:
                return in_array($targetNumber, [1, 3, 5, 6, 7, 8, 9, 0]) ? "<fg=red;bg=yellow> $targetNumber </>" : " $targetNumber ";
            case 8:
                return in_array($targetNumber, [2, 4, 6, 7, 8, 9, 0]) ? "<fg=red;bg=yellow> $targetNumber </>" : " $targetNumber ";
            case 9:
                return in_array($targetNumber, [1, 3, 5, 6, 7, 8, 9, 0]) ? "<fg=red;bg=yellow> $targetNumber </>" : " $targetNumber ";
            case 0:
                return in_array($targetNumber, [2, 4, 6, 7, 8, 9, 0]) ? "<fg=red;bg=yellow> $targetNumber </>" : " $targetNumber ";
        }
    }

    public function compartment($word)
    {
        return $word . '  ||  ';
    }
}
//第1名：0,1,3,4,5,7,9

//區間 247
