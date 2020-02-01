<?php

namespace App\Console\Commands;

use App\Period;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class mff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mf';

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
//        $array[1] = '<fg=red;bg=yellow> '.$data->one.' </>';


        $missNumberNew = [];
        $missNumberOld = [];
        $tag    = null;
        $datas  = app(Period::class)->orderBy('period')->get();

        $x = 0;
        foreach ($datas as $data) {
            $data->period;
            $data->one;

            if (in_array($data->one, [1,2,3,4,7,8,9])) {
                $x += 29;
            } else {
                $x -= 70;
            }
            $this->line($x . ' - ' . $data->one);

//            $tag = $data->one;
//            if ($tag == 0) {
//                $tag = 10;
//            }
//
//            $missNumberNew[] = $array[$tag];
//            $array[$tag] = "<fg=red;bg=yellow>$array[$tag]</>";
//
//            $tag++;
//
//
//            if ($tag > 10) {
//                $tag = 1;
//            }
//
//            $missNumberNew[] = $array[$tag];
//            $array[$tag] = "<fg=red;bg=yellow>$array[$tag]</>";
//
//            $tag++;
//
//            if ($tag > 10) {
//                $tag = 1;
//            }
//
//            $missNumberNew[] = $array[$tag];
//            $array[$tag] = "<fg=red;bg=yellow>$array[$tag]</>";
//
//
//            $this->line("$array[0]期 <fg=red;> $result </> $array[1]$array[2]$array[3]$array[4]$array[5]$array[6]$array[7]$array[8]$array[9]$array[10]");
//            $missNumberOld = $missNumberNew;

        }
    }
}
