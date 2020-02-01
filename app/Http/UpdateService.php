<?php

namespace App\Http;

use App\Period;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UpdateService
{
    public function updateLottery()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://www.luckyairship.com/api/getwiningnumbers.ashx');
        $data = json_decode($response->getBody());

        $period = $data->openedPeriodNumber;
        $numbers = $data->numbersArray;
        if (empty($numbers)) {
            echo $period . ' 未開獎\n';
        } else {
            $saveData['period'] = $period;
            $saveData['one'] = str_split($numbers[0])[count(str_split($numbers[0])) - 1];
            $saveData['two'] = str_split($numbers[1])[count(str_split($numbers[1])) - 1];
            $saveData['three'] = str_split($numbers[2])[count(str_split($numbers[2])) - 1];
            $saveData['four'] = str_split($numbers[3])[count(str_split($numbers[3])) - 1];
            $saveData['five'] = str_split($numbers[4])[count(str_split($numbers[4])) - 1];
            $saveData['six'] = str_split($numbers[5])[count(str_split($numbers[5])) - 1];
            $saveData['seven'] = str_split($numbers[6])[count(str_split($numbers[6])) - 1];
            $saveData['eight'] = str_split($numbers[7])[count(str_split($numbers[7])) - 1];
            $saveData['nine'] = str_split($numbers[8])[count(str_split($numbers[8])) - 1];
            $saveData['ten'] = str_split($numbers[9])[count(str_split($numbers[9])) - 1];
            app(Period::class)->updateOrCreate($saveData);
            echo "success\n";
        }
    }
}
