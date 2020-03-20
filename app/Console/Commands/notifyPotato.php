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
        $this->ala(67);
        $this->ala(68);
        $this->ala(139);
        $this->ala(140);
        $this->ala(211);
        $this->ala(212);
        $this->ala(283);
        $this->ala(284);
        $this->ala(355);
        $this->ala(356);
        $this->ala(427);
        $this->ala(428);
        $this->ala(499);
        $this->ala(500);
        $this->ala(571);
        $this->ala(572);
        $this->ala(643);
        $this->ala(644);
        $this->ala(715);
        $this->ala(716);





        $this->ala(69);
        $this->ala(70);
        $this->ala(141);
        $this->ala(142);
        $this->ala(213);
        $this->ala(214);
        $this->ala(285);
        $this->ala(286);
        $this->ala(357);
        $this->ala(358);
        $this->ala(429);
        $this->ala(430);
        $this->ala(501);
        $this->ala(502);
        $this->ala(573);
        $this->ala(574);
        $this->ala(645);
        $this->ala(646);
        $this->ala(717);
        $this->ala(718);

        $this->ala(71);
        $this->ala(72);
        $this->ala(143);
        $this->ala(142);
        $this->ala(215);
        $this->ala(216);
        $this->ala(287);
        $this->ala(288);
        $this->ala(359);
        $this->ala(360);
        $this->ala(431);
        $this->ala(432);
        $this->ala(503);
        $this->ala(504);
        $this->ala(575);
        $this->ala(576);
        $this->ala(647);
        $this->ala(648);
        $this->ala(719);
        $this->ala(720);
    }

    public function ala($id)
    {

        $url    = 'http://www.61xyft.com/plan-info?id=' . $id;
        $buffer = file($url);
        for ($i = 0; $i < sizeof($buffer); $i++) {
            $n1 = strpos(" " . $buffer[$i], '<span class="m-ww">');
            if ($n1 > 0) {
                $buffer[$i] = str_replace('<div class="l1-4"><span class="m-ww">', '', $buffer[$i]);
                $buffer[$i] = str_replace('</span></div>', '', $buffer[$i]);
                $buffer[$i] = str_replace("\t\t  ", '', $buffer[$i]);
                $status     = str_replace("\r\n", '', $buffer[$i]);
            }

            $n1 = strpos(" " . $buffer[$i], '<span class="mjh-new">');
            if ($n1 > 0) {
                $buffer[$i] = str_replace('<div class="l1-2"><span class="mjh-new">', '', $buffer[$i]);
                $buffer[$i] = str_replace('<span class=\'mjh-ge\'>, </span>', ',', $buffer[$i]);
                $buffer[$i] = str_replace('</span></div>', '', $buffer[$i]);
                $buffer[$i] = str_replace("\t\t  ", '', $buffer[$i]);
                $number     = str_replace("\r\n", '', $buffer[$i]);
            }

            $n1 = strpos(" " . $buffer[$i], '<span class="mjh-new-f">');
            if ($n1 > 0) {
                $buffer[$i] = str_replace("\t      <div class=\"l1-1\"><span class=\"mjh-new-f\">", '', $buffer[$i]);
                $period     = str_replace("</span></div>\r\n", '', $buffer[$i]);

            }

            $n1 = strpos(" " . $buffer[$i], '<div class="aa1 on">');
            if ($n1 > 0) {
                $buffer[$i] = str_replace("     <a href=\"../plan/jh" . $id . ".html\"><div class=\"aa1 on\">", '', $buffer[$i]);
                $buffer[$i] = str_replace("&nbsp;&nbsp;<b>", ' (', $buffer[$i]);
                $name       = str_replace("</b></div></a>\r\n", ')', $buffer[$i]);


            }

            $n1 = strpos(" " . $buffer[$i], '<div class="jh-t2">');
            if ($n1 > 0) {
                $buffer[$i] = str_replace("\t <div class=\"jh-t2\">", '', $buffer[$i]);
                $buffer[$i] = str_replace("</div>\r\n", '', $buffer[$i]);
                $rank       = str_replace("定胆&nbsp;-&nbsp;", ' ', $buffer[$i]);
            }


//            <div class="jh-t">
//	 <div class="jh-t1">预测期数</div>
//	 <div class="jh-t2">第三名定胆&nbsp;-&nbsp;7码6期</div>
//	 <div class="jh-t3">开奖</div>
//	 <div class="jh-t4">结果&nbsp;&nbsp;</div>
//</div>
//            <div class="jh-t2">冠军定胆&nbsp;-&nbsp;7码6期</div>
        }

        $this->line($rank . ' - ' . $name . ' - ' . $period . ' - ' . $number . ' - ' . $status);
    }

    public function notifySlack($msg, $count)
    {
        app(SlackNotify::class)->setMsg("極速賽車 $msg $count 連")->notify();
    }

}
