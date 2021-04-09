<?php

namespace App\Console\Commands;

use App\Period;
use App\PeriodManCar;
use App\Airship10;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use GuzzleHttp\Cookie\CookieJar;

class upAirship extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'u';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更新期數 https://luckyaireship.com/history.html';

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
        $client = new Client();

        $time = date('Ymd');

        $url = "https://luckyaireship.com/jie.php?riqi={$time}";
        $res = $client->request('GET', $url)->getBody();
        $res = explode('</br>',$res);
        unset($res[0]);
        unset($res[1]);

        foreach ($res as $key => $re) {
            if ($key == count($res) + 1) {
                $this->info('doen');
                exit;
            }
            $period = explode('----',$re)[0];
            $numbers = explode(',',explode('----',$re)[1]);

            $this->info($period);
            $this->update($period, $numbers);
        }
    }

    public function update($period, $data)
    {
                $period  = $period;
        $rank1   = $data[0] == 10 ? 0 : $data[0];
        $rank2   = $data[1] == 10 ? 0 : $data[1];
        $rank3   = $data[2] == 10 ? 0 : $data[2];
        $rank4   = $data[3] == 10 ? 0 : $data[3];
        $rank5   = $data[4] == 10 ? 0 : $data[4];
        $rank6   = $data[5] == 10 ? 0 : $data[5];
        $rank7   = $data[6] == 10 ? 0 : $data[6];
        $rank8   = $data[7] == 10 ? 0 : $data[7];
        $rank9   = $data[8] == 10 ? 0 : $data[8];
        $rank10  = $data[9] == 10 ? 0 : $data[9];
        $sum12   = $rank1 + $rank2;
        $sumBS   = $sum12 <= 11 ? '小' : '大';
        $sumSD   = $sum12 % 2 ? '單' : '雙';
        $animal1 = $rank1 > $rank10 ? '龍' : '虎';
        $animal2 = $rank2 > $rank9 ? '龍' : '虎';
        $animal3 = $rank3 > $rank8 ? '龍' : '虎';
        $animal4 = $rank4 > $rank7 ? '龍' : '虎';
        $animal5 = $rank5 > $rank6 ? '龍' : '虎';

        // app(Airship10::class)->updateOrCreate([
        //         'period'   => $period,
        //         'rank_1'   => $rank1,
        //         'rank_2'   => $rank2,
        //         'rank_3'   => $rank3,
        //         'rank_4'   => $rank4,
        //         'rank_5'   => $rank5,
        //         'rank_6'   => $rank6,
        //         'rank_7'   => $rank7,
        //         'rank_8'   => $rank8,
        //         'rank_9'   => $rank9,
        //         'rank_10'  => $rank10,
        //         'sum_12'   => $sum12,
        //         'sum_bs'   => $sumBS,
        //         'sum_sd'   => $sumSD,
        //         'animal_1' => $animal1,
        //         'animal_2' => $animal2,
        //         'animal_3' => $animal3,
        //         'animal_4' => $animal4,
        //         'animal_5' => $animal5,
        //     ]
        // );

        app(Period::class)->updateOrCreate([
            'period'   => $period,
            'one'   => $rank1,
            'two'   => $rank2,
            'three'   => $rank3,
            'four'   => $rank4,
            'five'   => $rank5,
            'six'   => $rank6,
            'seven'   => $rank7,
            'eight'   => $rank8,
            'nine'   => $rank9,
            'ten'  => $rank10,
        ]
    );

        $this->line($period);
    }
}
