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
        $六關 = 6;

        for ($i = 1; $i < 100; $i++) {
            try {
                //龍虎
                $this->ala('8', 120);
                
                $this->ala('animal', 534);
                $this->ala('animal', 528);
                $this->ala('animal', 540);
                $this->ala('animal', 522);
                $this->ala('animal', 516);
                $this->ala('animal', 510);
                $this->ala('animal', 504);
                $this->ala('animal', 498);
                $this->ala('animal', 492);
                $this->ala('animal', 486);

                //單雙
                $this->ala('SD', 480);
                $this->ala('SD', 474);
                $this->ala('SD', 462);
                $this->ala('SD', 468);
                $this->ala('SD', 456);
                $this->ala('SD', 450);
                $this->ala('SD', 444);
                $this->ala('SD', 438);
                $this->ala('SD', 432);
                $this->ala('SD', 426);
                
                //大小
                $this->ala('BS', 396);
                $this->ala('BS', 414);
                $this->ala('BS', 420);
                $this->ala('BS', 408);
                $this->ala('BS', 402);
                $this->ala('BS', 390);
                $this->ala('BS', 384);
                $this->ala('BS', 378);
                $this->ala('BS', 372);
                $this->ala('BS', 366);

                //三碼
                $this->ala('3', 175);
                $this->ala('3', 169);
                $this->ala('3', 295);
                $this->ala('3', 349);
                $this->ala('3', 229);
                $this->ala('3', 109);
                $this->ala('3', 289);
                $this->ala('3', 355);
                $this->ala('3', 235);
                $this->ala('3', 115);

                //四碼
                $this->ala('4', 170);
                $this->ala('4', 350);
                $this->ala('4', 110);
                $this->ala('4', 236);
                $this->ala('4', 296);
                $this->ala('4', 176);
                $this->ala('4', 230);
                $this->ala('4', 290);
                $this->ala('4', 356);
                $this->ala('4', 116);

                //五碼
                $this->ala('5', 291);
                $this->ala('5', 237);
                $this->ala('5', 177);
                $this->ala('5', 357);
                $this->ala('5', 231);
                $this->ala('5', 351);
                $this->ala('5', 297);
                $this->ala('5', 171);
                $this->ala('5', 117);
                $this->ala('5', 111);

                //六碼
                $this->ala('6', 118);
                $this->ala('6', 172);
                $this->ala('6', 178);
                $this->ala('6', 232);
                $this->ala('6', 238);
                $this->ala('6', 292);
                $this->ala('6', 298);
                $this->ala('6', 352);
                $this->ala('6', 358);
                $this->ala('6', 112);

                //七碼
                $this->ala('7', 359);
                $this->ala('7', 353);
                $this->ala('7', 299);
                $this->ala('7', 293);
                $this->ala('7', 239);
                $this->ala('7', 233);
                $this->ala('7', 179);
                $this->ala('7', 173);
                $this->ala('7', 119);
                $this->ala('7', 113);

                //八碼
                $this->ala('8', 114);
                $this->ala('8', 120);
                $this->ala('8', 174);
                $this->ala('8', 180);
                $this->ala('8', 234);
                $this->ala('8', 240);
                $this->ala('8', 294);
                $this->ala('8', 300);
                $this->ala('8', 354);
                $this->ala('8', 360);

                $this->info('----------------------');
                
                sleep(30);
                $i--;
            } catch (\Exception $error) {
                dd($error);
                app(SlackNotify::class)->setMsg('error')->notify();
            }
        }
    }

    public function ala($type, $id)
    {
        $url    = 'http://www.97xyft.com/plan/?id=' . $id;
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
                $this->info("{$id} - {$type} - {$period} - {$limit} - {$number}");
                break;
            case '第5期':
                $this->info("{$id} - {$type} - {$period} - {$limit} - {$number}");
                break;
            case '第6期':
                $this->info("{$id} - {$type} - {$period} - {$limit} - {$number}");
                $this->notifySlack("http://www.61xyft.com/plan/jh{$id}.html {$type} - {$period} - {$limit} - {$number}");
                break;
        }
    }

    public function notifySlack($msg)
    {
        app(SlackNotify::class)->setMsg($msg)->notify();
    }

}
