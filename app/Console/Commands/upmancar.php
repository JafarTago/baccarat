<?php

namespace App\Console\Commands;

use App\Period;
use App\PeriodManCar;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use GuzzleHttp\Cookie\CookieJar;

class upmancar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'uman {limit?}';

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
        $client = new Client();

        for ($i = 0; $i < 10; $i++) {

            $cookieJar = CookieJar::fromArray(['PHPSESSID' => 'n94oj5icde2k7jj9u0gkhf2mv3'], 'apigame.fere365.com');

            $data = [
                'page'          => 1,
                'search_date'   => '2020-02-28',
                'game_category' => 104,
            ];

            $url      = 'https://apigame.fere365.com/op/game_result_record_op.php?pdisplay=show_game_result_list';
            $response = $client->post($url, ['form_params' => $data, 'cookies' => $cookieJar]);

            $body = $response->getBody(); //獲取響應體，物件
            $body = json_decode($body)->root->ajaxdata[0]->rtntext;
            if ($body == "location.href='https://apigame.fere365.com/login.php';") {
                $this->line('error!!!!!!');
                $i == 0;
                continue;
            }
            $body = str_replace(" ", '', $body);


            $body = str_replace('<!--slot=1-->', '', $body);
            $body = str_replace('<!--newstorebutton-->', '', $body);
            $body = str_replace('<divclass="table-responsive">', '', $body);
            $body = str_replace('<tableclass="game-result-record-tabletable-bordered">', '', $body);
            $body = str_replace('<thead>', '', $body);
            $body = str_replace('<trclass="title">', '', $body);
            $body = str_replace('<th>期號</th>', '', $body);
            $body = str_replace('<th>開獎時間</th>', '', $body);
            $body = str_replace('<thcolspan="10">開獎內容</th>', '', $body);
            $body = str_replace('<thcolspan="3">冠亞軍和</th>', '', $body);
            $body = str_replace('<thcolspan="5">1~5龍虎</th>', '', $body);
            $body = str_replace('</tr>', '', $body);
            $body = str_replace('</thead>', '', $body);
            $body = str_replace('<tbody>', '', $body);
            $body = str_replace('<!--slot=2-->', '', $body);
            $body = str_replace('<tr>', '', $body);
            $body = str_replace('</tr>', '', $body);


            $body = str_replace("<td><spanclass=\"text-danger\">小</span></td>\n", "", $body);
            $body = str_replace("<td><spanclass=\"text-info\">大</span></td>\n", "", $body);
            $body = str_replace("<td><spanclass=\"text-info\">單</span></td>\n", "", $body);
            $body = str_replace("<td><spanclass=\"text-danger\">雙</span></td>\n", "", $body);
            $body = str_replace("<td><spanclass=\"text-info\">龍</span></td>\n", "", $body);
            $body = str_replace("<td><spanclass=\"text-danger\">虎</span></td>\n", "", $body);
            $body = str_replace("</td>\n", "</td>\g", $body);
            $body = str_replace("\n", '', $body);
            $body = str_replace("</td>\g", "</td>\n", $body);

            $body = str_replace('<spanclass="pk10car-1">', '', $body);
            $body = str_replace('<spanclass="pk10car-2">', '', $body);
            $body = str_replace('<spanclass="pk10car-3">', '', $body);
            $body = str_replace('<spanclass="pk10car-4">', '', $body);
            $body = str_replace('<spanclass="pk10car-5">', '', $body);
            $body = str_replace('<spanclass="pk10car-6">', '', $body);
            $body = str_replace('<spanclass="pk10car-7">', '', $body);
            $body = str_replace('<spanclass="pk10car-8">', '', $body);
            $body = str_replace('<spanclass="pk10car-9">', '', $body);
            $body = str_replace('<spanclass="pk10car-10">', '', $body);
            $body = str_replace('</span>', '', $body);
            $body = str_replace('<td>', '', $body);
            $body = str_replace('</td>', '', $body);
            $body = str_replace('</tbody></table><script>', '', $body);
            $body = str_replace('</script></div>', '', $body);
            $body = str_replace('function', '', $body);
            $body = str_replace('$((){', '', $body);
            $body = str_replace('initial_page_breaking', '', $body);
            $body = str_replace('(74,1)', '', $body);
            $body = str_replace('})', '', $body);
            $body = str_replace(';', '', $body);
            $body = str_replace("\t", '', $body);

            $body = explode("\n", $body);

            $i        = 0;
            $saveData = [];
            foreach ($body as $key => $data) {
                $i++;
                switch ($i) {
                    case 1:
                        $saveData['period'] = $data;
                        break;
                    case 2:
                        //日期，不執行
                        break;
                    case 3:
                        $saveData['one'] = $data == 10 ? 0 : $data;
                        break;
                    case 4:
                        $saveData['two'] = $data == 10 ? 0 : $data;
                        break;
                    case 5:
                        $saveData['three'] = $data == 10 ? 0 : $data;
                        break;
                    case 6:
                        $saveData['four'] = $data == 10 ? 0 : $data;
                        break;
                    case 7:
                        $saveData['five'] = $data == 10 ? 0 : $data;
                        break;
                    case 8:
                        $saveData['six'] = $data == 10 ? 0 : $data;
                        break;
                    case 9:
                        $saveData['seven'] = $data == 10 ? 0 : $data;
                        break;
                    case 10:
                        $saveData['eight'] = $data == 10 ? 0 : $data;
                        break;
                    case 11:
                        $saveData['nine'] = $data == 10 ? 0 : $data;
                        break;
                    case 12:
                        $saveData['ten'] = $data == 10 ? 0 : $data;
                        break;
                    case 13:
                        app(PeriodManCar::class)->updateOrCreate($saveData);

                        $this->line($saveData['period'] . ' 更新成功');
                        $saveData = [];
                        $i        = 0;
                        break;
                }
            }
            $limit = $this->argument('limit');
            $limit = is_null($limit) ? 15 : $limit;
            $datas = app(PeriodManCar::class)->limit($limit)->orderByDesc('period')->get()->toArray();

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

            foreach ($group as $key => $g) {
                ksort($group[$key]);
            }

            $this->line("\n近 $limit 期熱碼整理");
            $this->line('流水號：1 2 3 4 5 6 7');
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
            $group = [];
            $i--;
            sleep(5);
        }

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
