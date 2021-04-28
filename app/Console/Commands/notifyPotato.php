<?php

namespace App\Console\Commands;

use App\Helpers\SlackNotify;
use App\Period;
use App\PeriodManCar;
use App\Racing10;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use GuzzleHttp\Cookie\CookieJar;

class notifyPotato extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifyPotato';

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

        $this->go();

    }

    public function go()
    {




        for ($i = 1; $i < 100; $i++) {
            try {
                // //龍虎
                // $this->ala(534);
                // $this->ala(528);
                // $this->ala(540);
                // $this->ala(522);
                // $this->ala(516);
                // $this->ala(510);
                // $this->ala(504);
                // $this->ala(498);
                // $this->ala(492);
                // $this->ala(486);

                // //單雙
                // $this->ala(480);
                // $this->ala(474);
                // $this->ala(462);
                // $this->ala(468);
                // $this->ala(456);
                // $this->ala(450);
                // $this->ala(444);
                // $this->ala(438);
                // $this->ala(432);
                // $this->ala(426);
                
                // //大小
                // $this->ala(396);
                // $this->ala(414);
                // $this->ala(420);
                // $this->ala(408);
                // $this->ala(402);
                // $this->ala(390);
                // $this->ala(384);
                // $this->ala(378);
                // $this->ala(372);
                // $this->ala(366);

                //三碼
                $this->ala(175);
                $this->ala(169);
                $this->ala(295);
                $this->ala(349);
                $this->ala(229);
                $this->ala(109);
                $this->ala(289);
                $this->ala(355);
                $this->ala(235);
                $this->ala(115);

                //四碼
                $this->ala(170);
                $this->ala(350);
                $this->ala(110);
                $this->ala(236);
                $this->ala(296);
                $this->ala(176);
                $this->ala(230);
                $this->ala(290);
                $this->ala(356);
                $this->ala(116);

                //五碼
                $this->ala(291);
                $this->ala(237);
                $this->ala(177);
                $this->ala(357);
                $this->ala(231);
                $this->ala(351);
                $this->ala(297);
                $this->ala(171);
                $this->ala(117);
                $this->ala(111);

                //六碼
                $this->ala(118, true);
                $this->ala(172, true);
                $this->ala(178, true);
                $this->ala(232, true);
                $this->ala(238, true);
                $this->ala(292, true);
                $this->ala(298, true);
                $this->ala(352, true);
                $this->ala(358, true);
                $this->ala(112, true);

                //七碼
                $this->ala(359, true);
                $this->ala(353, true);
                $this->ala(299, true);
                $this->ala(293, true);
                $this->ala(239, true);
                $this->ala(233, true);
                $this->ala(179, true);
                $this->ala(173, true);
                $this->ala(119, true);
                $this->ala(113, true);

                //八碼
                $this->ala(114, true);
                $this->ala(120, true);
                $this->ala(174, true);
                $this->ala(180, true);
                $this->ala(234, true);
                $this->ala(240, true);
                $this->ala(294, true);
                $this->ala(300, true);
                $this->ala(354, true);
                $this->ala(360, true);

                $this->info('----------------------');
                
                // 這裡寫開獎的地方
                // for ($ii = 0; $ii < 999; $ii++) {
                //     $url = 'http://luckyairyship.com/api/getwiningnumbers?random=0.46040559494045175';
                //     $buffer = file($url);
                //     $periodData = json_decode($buffer[0]);
                //     $this->info($periodData->totalSeconds);
                //     $number = null;
                //     foreach ($periodData->numbersArray as $data) {
                //         $number .= $data.', ';
                //     }
            
                //     $period = $periodData->openingPeriodNumber;
            
                //     if (isset($nextPeriod) && $period == $nextPeriod) {
                //         app(SlackNotify::class)->setMsg($period - 1 . ' - ' . $number)->notify();
                //         continue;
                //     }
            
                //     $nextPeriod = $period + 1;
                // }
                
                $i--;
            } catch (\Exception $error) {
                dd($error);
                app(SlackNotify::class)->setMsg('error')->notify();
            }
        }
    }

    private function getRank($id)
    {
        $url = "http://www.61xyft.com/plan/jh{$id}.html";
        $buffer = file($url);
        
        $x = null;
        foreach ($buffer as $v) {
            $x .= $v;
        }
        
        return explode('</h1></div>',explode('<div class="top-c"><h1>', $x)[1])[0];
    }

    public function ala($id, $五碼狀態 = false)
    {
        echo '.';
        
        $this->getRank($id);
        $url    = 'http://www.61xyft.com/info-plan1/?id=' . $id;
        $buffer = file($url);
        
        $x = null;
        foreach ($buffer as $v) {
            $x .= $v;
        }

        $x = explode('<div class="jh1-a">', $x)[1];
        $c = explode('<div class="jh2-b1">', $x)[1];
        $c = explode("<span class='jh-line-f'>,</span> ", $c);
        $c[count($c)-1] = str_replace("\r\n","",$c[count($c)-1]);
        $c[count($c)-1] = str_replace(" ","",$c[count($c)-1]);
        $c[count($c)-1] = str_replace('</div></div></div></div><divclass="jh-list"><divclass="jh-info"><divclass="jh1">',"",$c[count($c)-1]);
        
        $period = explode("期&nbsp;&nbsp;&nbsp;&nbsp;<span class='jh-ww-f'>",$x)[0];
        $limit = substr(explode("期&nbsp;&nbsp;&nbsp;&nbsp;<span class='jh-ww-f'>",$x)[1], 0,7);
        
        $number = null;
        foreach ($c as $v) {
            $number .= $v . ', ';
        }
        
        switch ($limit) {
            case '第4期':
                // $this->info("{$limit} - i{$period} - {$this->getRank($id)} - {$number}");
                break;
            case '第5期':
                // $this->info("{$limit} - i{$period} - {$this->getRank($id)} - {$number}");
                // if ($五碼狀態) {
                //     $this->notifySlack("http://www.61xyft.com/plan/jh{$id}.html {$period} - {$this->getRank($id)} - {$number}");    
                // }
                break;
            case '第6期':
                $this->info("{$limit} - i{$period} - {$this->getRank($id)} - {$number}");
                $this->notifySlack("http://www.61xyft.com/plan/jh{$id}.html {$period} - {$this->getRank($id)} - {$number}");
                break;
        }
    }

    public function notifySlack($msg)
    {
        app(SlackNotify::class)->setMsg($msg)->notify();
    }

}
