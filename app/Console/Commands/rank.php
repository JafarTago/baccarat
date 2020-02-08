<?php

namespace App\Console\Commands;

use App\Http\UpdateService;
use App\Period;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class rank extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rank {rank?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '名次抓法';

    private $initStakeAmount = 10;

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

        $rank = $this->argument('rank');

        $getDataNumber = 30;
        $initMoney     = 0;
        $payMoney      = 10;
        $odds          = 9.925;
        $win           = $payMoney * 2.925;
        $lost          = $payMoney * 7;
        $checkPoint    = 1;
        $missNumberOld = [];
        $tag           = null;
        $offset        = app(Period::class)->count() - $getDataNumber;
        $datas         = app(Period::class)
            ->offset($offset)->limit($getDataNumber)
//                ->where('period','like','%20200118%')
            ->orderBy('period')->get();
        $observed      = 0;


        foreach ($datas as $data) {
            $result        = ' ';
            $missNumberNew = [];

            $array[0]  = $data->period;
            $array[1]  = " " . $data->one . " ";
            $array[2]  = " " . $data->two . " ";
            $array[3]  = " " . $data->three . " ";
            $array[4]  = " " . $data->four . " ";
            $array[5]  = " " . $data->five . " ";
            $array[6]  = " " . $data->six . " ";
            $array[7]  = " " . $data->seven . " ";
            $array[8]  = " " . $data->eight . " ";
            $array[9]  = " " . $data->nine . " ";
            $array[10] = " " . $data->ten . " ";

            if (is_null($tag)) {
                $tag = str_replace(' ', '', $array[$rank]);
                continue;
            }

            if (! in_array($array[$rank], $missNumberOld)) {
                $result = '✔';
//                $initMoney += $win;
                if ($observed) {
                    $observed = 0;
                } else {
                    $initMoney  -= $this->stakeAmountLost($checkPoint); // 先扣掉下注的錢
                    $initMoney  += $this->stakeAmountWin($checkPoint); // 在加回贏的錢
                    $checkPoint = 1; //贏了之後回第一關
                    $observed = 0;
                }
            } else {
                if (!$observed) {
                    $initMoney -= $this->stakeAmountLost($checkPoint);
                    $checkPoint++;
                    if ($checkPoint > 3) {
                        $checkPoint = 1; // 第四關爆掉回第一關
                    }
                }
                $result = ' ';
                if ($checkPoint > 2) { // 連二關沒過，觀一把
                    $observed = 1;
                }
//                $initMoney -= $lost;
            }

            $tag = str_replace(' ', '', $array[$rank]);
            if ($tag == 0) {
                $tag = 10;
            }

            $missNumberNew[] = $array[$tag];
            $array[$tag]     = "<fg=red;bg=yellow>$array[$tag]</>";

            $tag++;

            if ($tag > 10) {
                $tag = 1;
            }

            $missNumberNew[] = $array[$tag];
            $array[$tag]     = "<fg=red;bg=yellow>$array[$tag]</>";

            $tag++;

            if ($tag > 10) {
                $tag = 1;
            }

            $missNumberNew[] = $array[$tag];
            $array[$tag]     = "<fg=red;bg=yellow>$array[$tag]</>";

            $array[$rank] = "<fg=green>$array[$rank]</>"; // 鎖定名次，方便抓第幾名


            $this->line("$array[0]期 <fg=red;> $result </> $array[1]$array[2]$array[3]$array[4]$array[5]$array[6]$array[7]$array[8]$array[9]$array[10] / 關數：$checkPoint / 觀察：$observed / 剩餘本金：$initMoney");
            $missNumberOld = $missNumberNew;
        }
        $this->line('                  ' . ' 1  2  3  4  5  6  7  8  9  0');
    }

    public function stakeAmountWin($checkPoint)
    {
        $multiple    = 9.925;
        $stakeAmount = $this->initStakeAmount * $multiple;

        switch ($checkPoint) {
            case 1:
                return $stakeAmount * 1;
            case 2:
                return $stakeAmount * 4;
            case 3:
                return $stakeAmount * 15;
            default:
                dd('error msg： win 不應該有第四關');
        }
    }

    public function stakeAmountLost($checkPoint)
    {
        $checkPointLevel1 = 1;
        $checkPointLevel2 = 4;
        $checkPointLevel3 = 15;
        $numberOfSelect   = 7;

        switch ($checkPoint) {
            case 1:
                return $this->initStakeAmount * $numberOfSelect * $checkPointLevel1;
            case 2:
                return $this->initStakeAmount * $numberOfSelect * $checkPointLevel2;
            case 3:
                return $this->initStakeAmount * $numberOfSelect * $checkPointLevel3;
            default:
                dd('error msg： lost 不應該有第四關');
        }
    }
}
