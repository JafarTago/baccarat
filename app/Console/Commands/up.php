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
    protected $signature = 'u {page?}';

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
        $pages = is_null($this->argument('page')) ? 1 : $this->argument('page');

        for ($page = 1; $page <= $pages; $page++) {

            $url    = 'http://www.luckyairship.com/history.html?page=' . $page;
            $buffer = file($url);
            for ($i = 0; $i < sizeof($buffer); $i++) {
                $n1 = strpos(" " . $buffer[$i], "<td>"); //檢查你要找的字,是否存在,假設我想找<title>中的內容為何,為什麼前面要加空白,因為如果找到位置如果是第一個位置是0,0跟找不到在判斷會有問題
                if ($n1 > 0) {
                    $title = str_replace('<td><span class="ball1">', '', $buffer[$i]);
                    $title = str_replace('</span><span class="ball1">', ',', $title);
                    $title = str_replace('</span></td>', ',', $title);
                    $title = str_replace('<td>', '', $title);
                    $title = str_replace('</td>', '', $title);
                    $title = str_replace("\n", '', $title);
                    $title = str_replace("\r", '', $title);
                    $title = str_replace(" ", '', $title);

                    if (! strtotime($title)) { // 如果是日期，會回傳 true，則跳過不放入陣列
                        $datas[] = $title;
                    }
                }
            }

            foreach ($datas as $key => $data) {
                if ($key % 2 == 0) {
                    $saveData['period'] = $data;
                } else {
                    $data              = substr($data, 0, -1); // 最後一個逗點移除
                    $numbers           = explode(',', $data);
                    $saveData['one']   = $numbers[0] == 10 ? 0 : $numbers[0];
                    $saveData['two']   = $numbers[1] == 10 ? 0 : $numbers[1];
                    $saveData['three'] = $numbers[2] == 10 ? 0 : $numbers[2];
                    $saveData['four']  = $numbers[3] == 10 ? 0 : $numbers[3];
                    $saveData['five']  = $numbers[4] == 10 ? 0 : $numbers[4];
                    $saveData['six']   = $numbers[5] == 10 ? 0 : $numbers[5];
                    $saveData['seven'] = $numbers[6] == 10 ? 0 : $numbers[6];
                    $saveData['eight'] = $numbers[7] == 10 ? 0 : $numbers[7];
                    $saveData['nine']  = $numbers[8] == 10 ? 0 : $numbers[8];
                    $saveData['ten']   = $numbers[9] == 10 ? 0 : $numbers[9];
                    app(Period::class)->updateOrCreate($saveData);
                    $this->line($saveData['period'] . ' 更新成功');
                    $saveData = [];
                }

            }
        }


    }

//
//    private function convertion($number)
//    {
//        switch ($number) {
//            case 1:
//                return 'one';
//                break;
//            case 2:
//                return 'two';
//                break;
//            case 3:
//                return 'three';
//                break;
//            case 4:
//                return 'four';
//                break;
//            case 5:
//                return 'five';
//                break;
//            case 6:
//                return 'six';
//                break;
//            case 7:
//                return 'seven';
//                break;
//            case 8:
//                return 'eight';
//                break;
//            case 9:
//                return 'nine';
//                break;
//            case 10:
//                return 'ten';
//                break;
//        }
//    }
}



////        $x     = $this->argument('a');
//$datas = json_decode($x)->data->items;
//
//foreach ($datas as $key => $data) {
//    $g['period'] = $data->roundId;
//    foreach ($data->result as $v) {
//        if ($v->placeId <= 10) {
//
//            foreach ($v->guessIds as $vv) {
//                if ($vv == 10) {b高
//                    $g[$this->convertion($v->placeId)] = 0;
//                } else if ($vv < 10) {
//                    $g[$this->convertion($v->placeId)] = $vv;
//                }
//            }
//        }
//    }
//
//    ksort($g);
//    app(Period::class)->updateOrCreate($g);
//}

//第六名：0,1,2,5,6,7,8 3
//第八名：2,3,4,6,7,8,9 50

//03 start
//第八名：0,2,4,5,6,7,9
