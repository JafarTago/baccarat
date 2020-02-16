<?php

namespace App\Console\Commands;

use App\Period;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use GuzzleHttp\Cookie\CookieJar;

class uphmx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'uu';

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

        $cookieJar = CookieJar::fromArray([
            'PHPSESSID' => 'jb49cn9lj774fnb3m9g9d14e67'
        ], 'apigame.fere365.com');


        $data = [
            'page'          => 1,
            'search_date'   => '2020-02-15',
            'game_category' => 104,
        ];
//        $data['security'] = $this->getNonce();
//        $data['action'] = 'nf_ajax_submit';
//        $data['formData'] = $request->all();
//        dd($data);
//        $data = json_encode($data);
//        dd($data);
//
        $url = 'https://apigame.fere365.com/op/game_result_record_op.php?pdisplay=show_game_result_list';
        $response = $client->post($url, ['cookies' => $cookieJar], ['form_params' => $data]);

        $body    = $response->getBody(); //獲取響應體，物件
        $bodyStr = (string) $body; //物件轉字串
        dd($bodyStr);

    }

}
