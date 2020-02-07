<?php

namespace App\Console\Commands;

use App\Http\UpdateService;
use App\Period;
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

        $targetNumber = $this->ask('What is your target number?');

        if (is_null($targetNumber)) {
            $targetNumber = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            $targetNumber = array_rand($targetNumber, 7);
        } else {
            $targetNumber = explode(',', $targetNumber);
        }

        $getDataNumber = is_null($this->argument('dataOfNumber')) ? 30 : $this->argument('dataOfNumber');
        $offset        = app(Period::class)->count() - $getDataNumber;
        $datas         = app(Period::class)->offset($offset)->limit($getDataNumber)->orderBy('period')->get()->toArray();

        foreach ($datas as $key => $data) {

            $word = $data['period'] . '   ';
            foreach ($data as $key => $number) {

                if ($key == 'id' || $key == 'period' || $key == 'schedule_time') {  //這三個欄位不要判斷，和中獎無關係
                    continue;
                }

                if (in_array($number, $targetNumber)) {
                    $word .= '<fg=red;bg=yellow> ' . $number . ' </>';
                } else {
                    $word .= ' ' . $number . ' ';
                }
            }

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

        $this->line('       名次   ' . ' 1  2  3  4  5  6  7  8  9  0');
        $this->line("\n選取號碼：" . implode(",", $targetNumber));

        $this->line("\n熱碼整理");
        $this->line('流水號：1,2,3,4,5,6,7');
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

    public function hotNumber($data, $rank)
    {
        $word = $rank . '：';
        foreach ($data as $v) {
            $word .= "$v,";
        }

        $word = substr($word,0,-1); // 最後一個逗點移除

        return $word;
    }
}
//第七名：0,1,2,3,4,8,9
