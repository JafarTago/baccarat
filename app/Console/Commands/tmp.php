<?php

namespace App\Console\Commands;

use App\Period;
use App\PeriodManCar;
use App\Airship10;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use GuzzleHttp\Cookie\CookieJar;

class tmp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'tmp';

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
        $currently = 1;
        $client = new Client();

        $rKey = 'LaHcUsaOpACTd%2BCfpAwipWXQGfSWvQ%2B0NItcM5iakzvr%2FS0qxhhWJ6HJYY36iLbI0vvl4iwr05caN%2FqInT7%2BYD1IToZVWnH1yaHfVcUuy5WbM1YLnnT%2BV%2FX6BGhVXtPFWJqgUsx1ST1KflJ8lFSVVuj1MSG4OaddPrJkeYVd55U%3D';
        $cookieJar = CookieJar::fromArray(['NSESSID' => 's%3ADupden_rel_g5z8-V3_cOFEjYxAl_RPe.dXY%2BIEx4ZiC1juje%2FpaO2AG9ijn%2BXa4j6ytUpzmnxs8'], '.noxinfluencer.com');
        
        $minFans = 100;
        $maxFans = 200;
        // $url      = "https://tw.noxinfluencer.com/api/youtube/search/channel?searchMode=name&country=TW&pageNum=2&followerIndex=1&followerGte=10000&followerLte=50000&r=LaHcUsaOpACTd%2BCfpAwipWXQGfSWvQ%2B0NItcM5iakzvr%2FS0qxhhWJ6HJYY36iLbI0vvl4iwr05caN%2FqInT7%2BYD1IToZVWnH1yaHfVcUuy5WbM1YLnnT%2BV%2FX6BGhVXtPFWJqgUsx1ST1KflJ8lFSVVuj1MSG4OaddPrJkeYVd55U%3D";

        for ($i = 1; $i < 100; $i++) {
            $url      = "https://tw.noxinfluencer.com/api/youtube/search/channel?searchMode=name&pageSize=100&pageNum=1&country=TW&followerGte=$minFans&followerLte=$maxFans&sortField=followers&r=$rKey";

            $response = $client->get($url, ['cookies' => $cookieJar]);

            $body = json_decode($response->getBody())->retData->dom;

            $kolRowDatas = explode('<img src="', $body);
            unset($kolRowDatas[0]);
            
            foreach ($kolRowDatas as $kolRowData) {
                $description = null; // todo
                $categories = null; // todo
                $totalViews = $this->getTotalViews($kolRowData);
                $totalVideos = $this->getTotalVideos($kolRowData);
                $subscriptions = $this->getSubscriptions($kolRowData);
                $tags = $this->getTags($kolRowData);
                $kolInfo = explode('" alt="', $kolRowData);
                $kolAvator = $kolInfo[0];
                $kolName = explode('">', $kolInfo[1])[0];
                $channelKey = explode('">', explode('href="/youtube/channel/', $kolInfo[1])[1])[0];
                
                $this->info('第 ' . $currently . '個');
                $this->info('avator ' . $kolAvator);
                $this->info('kolName ' . $kolName);
                $this->info('channelKey ' . $channelKey);
                $this->info('subscriptions ' . $subscriptions);
                $this->info('totalViews ' . $totalViews);
                $this->info('totalVideos ' . $totalVideos);
                $this->info('tags ' . $tags);
                // $this->info('description ' . $description);
                // $this->info('categories ' . $categories);
                
                
                
                $this->info('----------');

                $currently++;

            }

            $minFans += 100;
            $maxFans += 100;
        }
    }

    private function getSubscriptions($body)
    {
        $data = explode('span class="base-number">', $body);
        
        //萬轉數字 todo
        return explode('</span>',$data[1])[0];
    }

    private function getTotalViews($body)
    {
        $data = explode('span class="base-number">', $body);
        
        //萬轉數字 todo
        return explode('</span>',$data[2])[0];
    }

    private function getTotalVideos($body)
    {
        $data = explode('span class="base-number">', $body);
        
        //萬轉數字 todo
        return explode('</span>',$data[3])[0];
    }

    private function getTags($body)
    {
        $tagsRowDatas = explode('&tagName=', $body);
        unset($tagsRowDatas[0]);

        $tags = null;
        foreach ($tagsRowDatas as $tagsRowData) {

            if (is_null($tags)) {
                $tags .= explode('">', $tagsRowData)[0];
            } else {
                $tags .= ',' . explode('">', $tagsRowData)[0];
            }
            
        }


        // 轉繁體 todo 參考 https://blog.xuite.net/lins690/teach/62378071
        return $tags;
    }

    // private function getSubscriptions($channelKey, $rKey, $cookieJar)
    // {
    //     $client = new Client();

    //     $url      = "https://tw.noxinfluencer.com/ws/star/videoTrend/$channelKey?pageSize=30&r=$rKey";
    //     $response = $client->get($url, ['cookies' => $cookieJar]);
    //     return json_decode($response->getBody())->retData->followers;
        
    // }
}
