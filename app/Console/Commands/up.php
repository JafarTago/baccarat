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
    protected $signature = 'u {date?}';

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
        $storageDate = is_null($this->argument('date')) ? date('Y-m-d') : $this->argument('date');

        while ($storageDate <= date('Y-m-d')) {
            $this->line('準備處理日期：' . $storageDate);
            $this->updateData($storageDate);
            $storageDate = date('Y-m-d', strtotime($storageDate. ' + 1 days'));
        }
    }

    public function updateData($date)
    {

        for ($page = 1; $page <= 3; $page++) {

            $url    = 'http://www.luckyairship.com/history.html?issue=&date=' . $date . '&page=' . $page;
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

            $this->line($date . ' 第 ' . $page.' 頁');
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
