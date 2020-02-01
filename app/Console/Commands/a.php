<?php

namespace App\Console\Commands;

use App\Period;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class a extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'a';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '對應';

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
        $getDataNumber = 60;
        $offset        = app(Period::class)->count() - $getDataNumber;
        $datas         = app(Period::class)->offset($offset)->limit($getDataNumber)->orderBy('period')->get()->toArray();

        $result = [];
        foreach ($datas as $key => $data) {
            if ($key == 0) {
                $targetNumber17 = [
                    $data['one'],
                    $data['two'],
                    $data['three'],
                    $data['four'],
                    $data['five'],
                    $data['six'],
                    $data['seven'],
                ];
                $targetNumber70 = [
                    $data['four'],
                    $data['five'],
                    $data['six'],
                    $data['seven'],
                    $data['eight'],
                    $data['nine'],
                    $data['ten'],
                ];
                continue;
            }

            $result[$key][] = $data['period'] . '   ';
            $result[$key][] = $this->isGet($data['one'], $targetNumber17);
            $result[$key][] = $this->isGet($data['two'], $targetNumber17);
            $result[$key][] = $this->isGet($data['three'], $targetNumber17);
            $result[$key][] = $this->isGet($data['four'], $targetNumber17);
            $result[$key][] = $this->isGet($data['five'], $targetNumber17);
            $result[$key][] = $this->isGet($data['six'], $targetNumber17);
            $result[$key][] = $this->isGet($data['seven'], $targetNumber17);
            $result[$key][] = $this->isGet($data['eight'], $targetNumber17);
            $result[$key][] = $this->isGet($data['nine'], $targetNumber17);
            $result[$key][] = $this->isGet($data['ten'], $targetNumber17);

            $result[$key][] = '  ||  ';

            $result[$key][] = $this->isGet($data['one'], $targetNumber70);
            $result[$key][] = $this->isGet($data['two'], $targetNumber70);
            $result[$key][] = $this->isGet($data['three'], $targetNumber70);
            $result[$key][] = $this->isGet($data['four'], $targetNumber70);
            $result[$key][] = $this->isGet($data['five'], $targetNumber70);
            $result[$key][] = $this->isGet($data['six'], $targetNumber70);
            $result[$key][] = $this->isGet($data['seven'], $targetNumber70);
            $result[$key][] = $this->isGet($data['eight'], $targetNumber70);
            $result[$key][] = $this->isGet($data['nine'], $targetNumber70);
            $result[$key][] = $this->isGet($data['ten'], $targetNumber70);
            $result[$key][] = '   ' . $data['period'];

            $targetNumber17 = [
                $data['one'],
                $data['two'],
                $data['three'],
                $data['four'],
                $data['five'],
                $data['six'],
                $data['seven'],
            ];


            $targetNumber70 = [
                $data['four'],
                $data['five'],
                $data['six'],
                $data['seven'],
                $data['eight'],
                $data['nine'],
                $data['ten'],
            ];
        }
        $word = null;
        foreach ($result as $v) {
            foreach ($v as $vv) {
//                dd($v);
                $word .= $vv;
            }
            $this->line($word);
            $word = null;
        }
        $this->line('       名次    1  2  3  4  5  6  7  8  9  0   ||   1  2  3  4  5  6  7  8  9  0    名次');
    }

    private function isGet($number, $targetNumber)
    {
        if (in_array($number, $targetNumber)) {
            return '<fg=red;bg=yellow> ' . $number . ' </>';
        } else {
            return ' ' . $number . ' ';
        }
    }

}
