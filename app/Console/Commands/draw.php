<?php

namespace App\Console\Commands;

use App\Http\UpdateService;
use App\Period;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class draw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'draw {target?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '開獎';

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
        $result = app(UpdateService::class)->updateLottery();
        $frequency = 1;
        while ($result <> 'success') {
            $result = app(UpdateService::class)->updateLottery();
            $this->line("$result - $frequency 次");
            $frequency++;
        }

        $draw = app(Period::class)->orderByDesc('period')->first();
        $word = ($draw->period . ' ' . '<fg=red;bg=yellow> ' . $draw->one. ' </>' . ' ' . '<fg=red;bg=yellow> ' . $draw->two. ' </>' . ' ' . '<fg=red;bg=yellow> ' . $draw->three. ' </>' . ' ' . '<fg=red;bg=yellow> ' . $draw->four. ' </>' . ' ' . '<fg=red;bg=yellow> ' . $draw->five. ' </>' . ' ' . '<fg=red;bg=yellow> ' . $draw->six. ' </>' . ' ' . '<fg=red;bg=yellow> ' . $draw->seven. ' </>' . ' ' . '<fg=red;bg=yellow> ' . $draw->eight. ' </>' . ' ' . '<fg=red;bg=yellow> ' . $draw->nine. ' </>' . ' ' . '<fg=red;bg=yellow> ' . $draw->ten. ' </>');

        $this->line("\n$word");
        $this->line('       名次  1   2   3   4   5   6   7   8   9   0');

        if ($target = $this->argument('target')) {
            $this->line("       瞄準 $target");
        }

        $this->line('');
    }
}

