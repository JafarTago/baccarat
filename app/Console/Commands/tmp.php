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
        $client = new Client();

        $data = [
            'id'   => 66,
        ];

        $url = "http://www.61xyft.com/info-plan1/?id=66";
        $response = $client->get($url)->getBody();
        // $response = json_decode($response);
        dd($response);

        $url = "http://www.61xyft.com/info-plan1";
        $response = $client->post($url, ['form_params' => $data])->getBody();

        dd($response);

    }
}
