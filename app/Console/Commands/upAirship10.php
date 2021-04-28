<?php

namespace App\Console\Commands;

use App\Period;
use App\PeriodManCar;
use App\Airship10;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use GuzzleHttp\Cookie\CookieJar;

class upAirship10 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upAirship10 {status?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更新期數';

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

        $url = 'http://luckyairyship.com/api/getwiningnumbers?random=0.46040559494045175';
        $buffer = file($url);
        $periodData = json_decode($buffer[0]);
        $number = null;
        foreach ($periodData->numbersArray as $data) {
            $number .= $data.', ';
        }

        $period = $periodData->openingPeriodNumber;

        $client = new Client();

        $time = date('Y-m-d');

        $postData = [
            'form_params' => [
                'gameid'    => 202,
                'matchdate' => $time
            ]];

        if ($this->argument('status') == 'n') {
            $url = 'https://www.onlinelottery.com.ph/papi/ltcur';

            for ($i = 0; $i < 10; $i++) {
                $response = $client->post($url, $postData);

                $body = $response->getBody();
                $data = json_decode($body)->matchcur->gamedata;

                $this->update($data);
                $i--;
                sleep(1);
            }
        } else {
            $url = 'https://www.onlinelottery.com.ph/papi/lthistory';

            $response = $client->post($url, $postData);

            $body = $response->getBody();
            $body = json_decode($body)->gamedata;

            foreach ($body as $data) {
                $this->update($data);
            }
            $this->line($time);
        }

    }

    public function update($data)
    {
        $period  = $data->matchnumber;
        $numbers = $data->n;
        $rank1   = $numbers[0];
        $rank2   = $numbers[1];
        $rank3   = $numbers[2];
        $rank4   = $numbers[3];
        $rank5   = $numbers[4];
        $rank6   = $numbers[5];
        $rank7   = $numbers[6];
        $rank8   = $numbers[7];
        $rank9   = $numbers[8];
        $rank10  = $numbers[9];
        $sum12   = $rank1 + $rank2;
        $sumBS   = $sum12 <= 11 ? '小' : '大';
        $sumSD   = $sum12 % 2 ? '單' : '雙';
        $animal1 = $rank1 > $rank10 ? '龍' : '虎';
        $animal2 = $rank2 > $rank9 ? '龍' : '虎';
        $animal3 = $rank3 > $rank8 ? '龍' : '虎';
        $animal4 = $rank4 > $rank7 ? '龍' : '虎';
        $animal5 = $rank5 > $rank6 ? '龍' : '虎';
        $time    = $data->opentime;

        app(Airship10::class)->updateOrCreate([
                'period'   => $period,
                'rank_1'   => $rank1,
                'rank_2'   => $rank2,
                'rank_3'   => $rank3,
                'rank_4'   => $rank4,
                'rank_5'   => $rank5,
                'rank_6'   => $rank6,
                'rank_7'   => $rank7,
                'rank_8'   => $rank8,
                'rank_9'   => $rank9,
                'rank_10'  => $rank10,
                'sum_12'   => $sum12,
                'sum_bs'   => $sumBS,
                'sum_sd'   => $sumSD,
                'animal_1' => $animal1,
                'animal_2' => $animal2,
                'animal_3' => $animal3,
                'animal_4' => $animal4,
                'animal_5' => $animal5,
                'time'     => $time,
            ]
        );

        $this->line($period);
    }
}
