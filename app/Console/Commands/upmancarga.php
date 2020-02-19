<?php

namespace App\Console\Commands;

use App\Period;
use App\PeriodManCar;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use GuzzleHttp\Cookie\CookieJar;

class upmancarga extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'umanga';

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
        $dg6 = $dg7 = $dg8 = $dg9 = $dg10 = $dg11 = $dg12 = $dg13 = $dg14 = $dg15 = 0;

        $count = app(PeriodManCar::class)->count();

        for ($offset = 0; $offset <= $count; $offset++) {

            $dg6  += $this->mdfk($offset, 6);
            $dg7  += $this->mdfk($offset, 7);
            $dg8  += $this->mdfk($offset, 8);
            $dg9  += $this->mdfk($offset, 9);
            $dg10 += $this->mdfk($offset, 10);
            $dg11 += $this->mdfk($offset, 11);
            $dg12 += $this->mdfk($offset, 12);
            $dg13 += $this->mdfk($offset, 13);
            $dg14 += $this->mdfk($offset, 14);

            $this->line("offset：$offset dg6：$dg6 dg7：$dg7 dg8：$dg8 dg9：$dg9 dg10：$dg10 dg11：$dg11 dg12：$dg12 dg13：$dg13 dg14：$dg14");


//            $this->line("\n近 $limit 期熱碼整理");
//            $this->line('流水號：1 2 3 4 5 6 7');
//            $this->line($this->hotNumber($group[1], '第一名'));
//            $this->line($this->hotNumber($group[2], '第二名'));
//            $this->line($this->hotNumber($group[3], '第三名'));
//            $this->line($this->hotNumber($group[4], '第四名'));
//            $this->line($this->hotNumber($group[5], '第五名'));
//            $this->line($this->hotNumber($group[6], '第六名'));
//            $this->line($this->hotNumber($group[7], '第七名'));
//            $this->line($this->hotNumber($group[8], '第八名'));
//            $this->line($this->hotNumber($group[9], '第九名'));
//            $this->line($this->hotNumber($group[10], '第十名'));


        }

//        $this->line("6: $dg6");
    }

    //暫時想不到名字
    public function mdfk($offset, $limit)
    {
        $dg    = 0;
        $datas = app(PeriodManCar::class)->offset($offset)->limit($limit)->orderBy('period')->get()->toArray();

        foreach ($datas as $key => $data) {
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
        }

        for ($i = 1; $i <= 10; $i++) {
            if (count($group[$i]) == 3) {
                $dg++;
            }
        }

        return $dg;
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


}
