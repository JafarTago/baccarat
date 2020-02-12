<?php

namespace App\Console\Commands;

use App\Http\UpdateService;
use App\Period;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class fv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fv {dataOfNumber?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '區間';

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

        $getDataNumber = is_null($this->argument('dataOfNumber')) ? 20 : $this->argument('dataOfNumber');
        $offset        = app(Period::class)->count() - $getDataNumber;
        $datas         = app(Period::class)->offset($offset)->limit($getDataNumber)->orderBy('period')->get()->toArray();

        $this->line('');
        foreach ($datas as $key => $data) {
            $word = $data['period'] . '  ';
            $word = $this->printNumber($data, [1], $word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, [2],$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, [3],$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, [4],$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, [5],$word);
            $this->line($word);
        }

        $this->line('       名次   1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0');
        $this->line('');
        foreach ($datas as $key => $data) {
            $word = $data['period'] . '  ';
            $word = $this->printNumber($data, [6], $word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, [7],$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, [8],$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, [9],$word);
            $word = $this->compartment($word);
            $word = $this->printNumber($data, [0],$word);
            $this->line($word);
        }

        $this->line('       名次   1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0        1  2  3  4  5  6  7  8  9  0');
        $this->line('');
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

    public function compartment($word)
    {
        return $word . '  ||  ';
    }
}
//第1名：0,1,3,4,5,7,9

//區間 247
