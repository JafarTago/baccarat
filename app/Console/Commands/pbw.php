<?php

namespace App\Console\Commands;

use App\Http\UpdateService;
use App\Period;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class pbw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pbw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '追號';

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

        $targetNumber = $this->ask('What is your target number?');
        if (is_null($targetNumber)) {
            $targetNumber = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            $targetNumber = array_rand($targetNumber, 1);
        } else {
            $targetNumber = explode(',',$targetNumber);
        }
        $getDataNumber = 2000;
        $offset        = app(Period::class)->count() - $getDataNumber;
        $datas         = app(Period::class)
            ->offset($offset)->limit($getDataNumber)
            ->orderBy('period')->get()->toArray();
//dd($datas);

        foreach ($datas as $key => $data) {

            $word = $data['period'] . '   ';
            foreach ($data as $key => $number) {

                if ($key == 'id' || $key == 'period' || $key == 'schedule_time') {
                    continue;
                }

                if (in_array($number, $targetNumber)) {
                    $word .= '<fg=red;bg=yellow> ' . $number . ' </>';
                } else {
                    $word .= ' ' . $data[$key] . ' ';
                }
            }

            $this->line($word . ' / ' . $data['schedule_time']);

        }
        $this->line('       名次   ' . ' 1  2  3  4  5  6  7  8  9  0');
        $this->line('number：' . implode(",", $targetNumber));
    }

}
// 下
// 2 - 670
// 0 - 0,1,5,6,7,8,9

// 翻


// 觀
