<?php

namespace App\Console\Commands;

use App\Period;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class up extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'u {a}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $x     = $this->argument('a');
        $datas = json_decode($x)->data->items;

        foreach ($datas as $key => $data) {
            $g['period'] = $data->roundId;
            foreach ($data->result as $v) {
                if ($v->placeId <= 10) {

                    foreach ($v->guessIds as $vv) {
                        if ($vv == 10) {
                            $g[$this->convertion($v->placeId)] = 0;
                        } else if ($vv < 10) {
                            $g[$this->convertion($v->placeId)] = $vv;
                        }
                    }
                }
            }

            ksort($g);
            app(Period::class)->updateOrCreate($g);
        }
    }

    private function convertion($number)
    {
        switch($number) {
            case 1:
                return 'one';
                break;
            case 2:
                return 'two';
                break;
            case 3:
                return 'three';
                break;
            case 4:
                return 'four';
                break;
            case 5:
                return 'five';
                break;
            case 6:
                return 'six';
                break;
            case 7:
                return 'seven';
                break;
            case 8:
                return 'eight';
                break;
            case 9:
                return 'nine';
                break;
            case 10:
                return 'ten';
                break;
        }
    }
}
