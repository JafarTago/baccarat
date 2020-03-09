<?php

namespace App\Console\Commands;

use App\Airship10;
use App\Helpers\SlackNotify;
use App\Period;
use App\PeriodManCar;
use App\Racing10;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;
use GuzzleHttp\Cookie\CookieJar;

class notifyAirship10 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifyAirship10 {time?}';

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
        $targetNumber = 9;
        for ($i = 0; $i < 10; $i++) {

            $time = is_null($this->argument('time')) ? date('Y-m-d') : $this->argument('time');

            $offset = app(Airship10::class)->count() - 20;
            $datas  = app(Airship10::class)
//            ->where('period','>=', 3500315)
//            ->where('period','<=', 3500337)
//            ->whereRaw("DATE_FORMAT(time, '%Y %m %d') = DATE_FORMAT('" . $time . "', '%Y %m %d')")
                ->orderBy('period')
                ->offset($offset)
                ->limit(20)
                ->get();

            $rank1BSCount  = 1;
            $rank2BSCount  = 1;
            $rank3BSCount  = 1;
            $rank4BSCount  = 1;
            $rank5BSCount  = 1;
            $rank6BSCount  = 1;
            $rank7BSCount  = 1;
            $rank8BSCount  = 1;
            $rank9BSCount  = 1;
            $rank10BSCount = 1;
            $rank1SDCount  = 1;
            $rank2SDCount  = 1;
            $rank3SDCount  = 1;
            $rank4SDCount  = 1;
            $rank5SDCount  = 1;
            $rank6SDCount  = 1;
            $rank7SDCount  = 1;
            $rank8SDCount  = 1;
            $rank9SDCount  = 1;
            $rank10SDCount = 1;
            $sumBSCount    = 1;
            $sumSDCount    = 1;
            $animal1Count  = 1;
            $animal2Count  = 1;
            $animal3Count  = 1;
            $animal4Count  = 1;
            $animal5Count  = 1;

            $rank1BSArray  = [];
            $rank2BSArray  = [];
            $rank3BSArray  = [];
            $rank4BSArray  = [];
            $rank5BSArray  = [];
            $rank6BSArray  = [];
            $rank7BSArray  = [];
            $rank8BSArray  = [];
            $rank9BSArray  = [];
            $rank10BSArray = [];
            $rank1SDArray  = [];
            $rank2SDArray  = [];
            $rank3SDArray  = [];
            $rank4SDArray  = [];
            $rank5SDArray  = [];
            $rank6SDArray  = [];
            $rank7SDArray  = [];
            $rank8SDArray  = [];
            $rank9SDArray  = [];
            $rank10SDArray = [];
            $sumBSArray    = [];
            $sumSDArray    = [];
            $animal1Array  = [];
            $animal2Array  = [];
            $animal3Array  = [];
            $animal4Array  = [];
            $animal5Array  = [];
            foreach ($datas as $key => $data) {
                if ($key == 0) {
                    $rank1BS  = $this->BS($data->rank_1);
                    $rank2BS  = $this->BS($data->rank_2);
                    $rank3BS  = $this->BS($data->rank_3);
                    $rank4BS  = $this->BS($data->rank_4);
                    $rank5BS  = $this->BS($data->rank_5);
                    $rank6BS  = $this->BS($data->rank_6);
                    $rank7BS  = $this->BS($data->rank_7);
                    $rank8BS  = $this->BS($data->rank_8);
                    $rank9BS  = $this->BS($data->rank_9);
                    $rank10BS = $this->BS($data->rank_10);
                    $rank1SD  = $this->SD($data->rank_1);
                    $rank2SD  = $this->SD($data->rank_2);
                    $rank3SD  = $this->SD($data->rank_3);
                    $rank4SD  = $this->SD($data->rank_4);
                    $rank5SD  = $this->SD($data->rank_5);
                    $rank6SD  = $this->SD($data->rank_6);
                    $rank7SD  = $this->SD($data->rank_7);
                    $rank8SD  = $this->SD($data->rank_8);
                    $rank9SD  = $this->SD($data->rank_9);
                    $rank10SD = $this->SD($data->rank_10);
                    $sumBS    = $data->sum_bs;
                    $sumSD    = $data->sum_sd;
                    $animal1  = $data->animal_1;
                    $animal2  = $data->animal_2;
                    $animal3  = $data->animal_3;
                    $animal4  = $data->animal_4;
                    $animal5  = $data->animal_5;
                    continue;
                }


                if ($rank1BS == $this->BS($data->rank_1)) {
                    $rank1BSCount++;
//                $this->line($data->period . ' | ' . $this->BS($data->rank_1) . ' | ' . $rank1BSCount . ' | ' . $data->time);
                } else {
                    if (! isset($rank1BSArray[$rank1BSCount])) {
                        $rank1BSArray[$rank1BSCount] = 1;
                    } else {
                        $rank1BSArray[$rank1BSCount] = $rank1BSArray[$rank1BSCount] + 1;
                    }
                    $rank1BSCount = 1;
//                $this->line($data->period . ' | ' . $this->BS($data->rank_1) . ' | ' . $rank1BSCount . ' | ' . $data->time);
                }

                if ($rank2BS == $this->BS($data->rank_2)) {
//                $this->line($data->period . ' | ' . $rank2BS . ' | ' . $rank2BSCount . ' | ' . $data->time);
                    $rank2BSCount++;
                } else {
                    if (! isset($rank2BSArray[$rank2BSCount])) {
                        $rank2BSArray[$rank2BSCount] = 1;
                    } else {
                        $rank2BSArray[$rank2BSCount] = $rank2BSArray[$rank2BSCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank2BS . ' | ' . $rank2BSCount . ' | ' . $data->time);
                    $rank2BSCount = 1;
                }

                if ($rank3BS == $this->BS($data->rank_3)) {
//                $this->line($data->period . ' | ' . $rank3BS . ' | ' . $rank3BSCount . ' | ' . $data->time);
                    $rank3BSCount++;
                } else {
                    if (! isset($rank3BSArray[$rank3BSCount])) {
                        $rank3BSArray[$rank3BSCount] = 1;
                    } else {
                        $rank3BSArray[$rank3BSCount] = $rank3BSArray[$rank3BSCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank3BS . ' | ' . $rank3BSCount . ' | ' . $data->time);
                    $rank3BSCount = 1;
                }

                if ($rank4BS == $this->BS($data->rank_4)) {
//                $this->line($data->period . ' | ' . $rank4BS . ' | ' . $rank4BSCount . ' | ' . $data->time);
                    $rank4BSCount++;
                } else {
                    if (! isset($rank4BSArray[$rank4BSCount])) {
                        $rank4BSArray[$rank4BSCount] = 1;
                    } else {
                        $rank4BSArray[$rank4BSCount] = $rank4BSArray[$rank4BSCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank4BS . ' | ' . $rank4BSCount . ' | ' . $data->time);
                    $rank4BSCount = 1;
                }

                if ($rank5BS == $this->BS($data->rank_5)) {
//                $this->line($data->period . ' | ' . $rank5BS . ' | ' . $rank5BSCount . ' | ' . $data->time);
                    $rank5BSCount++;
                } else {
                    if (! isset($rank5BSArray[$rank5BSCount])) {
                        $rank5BSArray[$rank5BSCount] = 1;
                    } else {
                        $rank5BSArray[$rank5BSCount] = $rank5BSArray[$rank5BSCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank5BS . ' | ' . $rank5BSCount . ' | ' . $data->time);
                    $rank5BSCount = 1;
                }

                if ($rank6BS == $this->BS($data->rank_6)) {
//                    $this->line($data->period . ' | ' . $rank6BS . ' | ' . $rank6BSCount . ' | ' . $data->time);
                    $rank6BSCount++;
                } else {
                    if (! isset($rank6BSArray[$rank6BSCount])) {
                        $rank6BSArray[$rank6BSCount] = 1;
                    } else {
                        $rank6BSArray[$rank6BSCount] = $rank6BSArray[$rank6BSCount] + 1;
                    }
//                    $this->line($data->period . ' | ' . $rank6BS . ' | ' . $rank6BSCount . ' | ' . $data->time);
                    $rank6BSCount = 1;
                }

                if ($rank7BS == $this->BS($data->rank_7)) {
//                $this->line($data->period . ' | ' . $rank7BS . ' | ' . $rank7BSCount . ' | ' . $data->time);
                    $rank7BSCount++;
                } else {
                    if (! isset($rank7BSArray[$rank7BSCount])) {
                        $rank7BSArray[$rank7BSCount] = 1;
                    } else {
                        $rank7BSArray[$rank7BSCount] = $rank7BSArray[$rank7BSCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank7BS . ' | ' . $rank7BSCount . ' | ' . $data->time);
                    $rank7BSCount = 1;
                }

                if ($rank8BS == $this->BS($data->rank_8)) {
//                $this->line($data->period . ' | ' . $rank8BS . ' | ' . $rank8BSCount . ' | ' . $data->time);
                    $rank8BSCount++;
                } else {
                    if (! isset($rank8BSArray[$rank8BSCount])) {
                        $rank8BSArray[$rank8BSCount] = 1;
                    } else {
                        $rank8BSArray[$rank8BSCount] = $rank8BSArray[$rank8BSCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank8BS . ' | ' . $rank8BSCount . ' | ' . $data->time);
                    $rank8BSCount = 1;
                }

                if ($rank9BS == $this->BS($data->rank_9)) {
//                $this->line($data->period . ' | ' . $rank9BS . ' | ' . $rank9BSCount . ' | ' . $data->time);
                    $rank9BSCount++;
                } else {
                    if (! isset($rank9BSArray[$rank9BSCount])) {
                        $rank9BSArray[$rank9BSCount] = 1;
                    } else {
                        $rank9BSArray[$rank9BSCount] = $rank9BSArray[$rank9BSCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank9BS . ' | ' . $rank9BSCount . ' | ' . $data->time);
                    $rank9BSCount = 1;
                }

                if ($rank10BS == $this->BS($data->rank_10)) {
//                $this->line($data->period . ' | ' . $rank10BS . ' | ' . $rank10BSCount . ' | ' . $data->time);
                    $rank10BSCount++;
                } else {
                    if (! isset($rank10BSArray[$rank10BSCount])) {
                        $rank10BSArray[$rank10BSCount] = 1;
                    } else {
                        $rank10BSArray[$rank10BSCount] = $rank10BSArray[$rank10BSCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank10BS . ' | ' . $rank10BSCount . ' | ' . $data->time);
                    $rank10BSCount = 1;
                }


                if ($rank1SD == $this->SD($data->rank_1)) {
//                $this->line($data->period . ' | ' . $rank1SD . ' | ' . $rank1SDCount . ' | ' . $data->time);
                    $rank1SDCount++;
                } else {
                    if (! isset($rank1SDArray[$rank1SDCount])) {
                        $rank1SDArray[$rank1SDCount] = 1;
                    } else {
                        $rank1SDArray[$rank1SDCount] = $rank1SDArray[$rank1SDCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank1SD . ' | ' . $rank1SDCount . ' | ' . $data->time);
                    $rank1SDCount = 1;
                }

                if ($rank2SD == $this->SD($data->rank_2)) {
//                $this->line($data->period . ' | ' . $rank2SD . ' | ' . $rank2SDCount . ' | ' . $data->time);
                    $rank2SDCount++;
                } else {
                    if (! isset($rank2SDArray[$rank2SDCount])) {
                        $rank2SDArray[$rank2SDCount] = 1;
                    } else {
                        $rank2SDArray[$rank2SDCount] = $rank2SDArray[$rank2SDCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank2SD . ' | ' . $rank2SDCount . ' | ' . $data->time);
                    $rank2SDCount = 1;
                }

                if ($rank3SD == $this->SD($data->rank_3)) {
//                $this->line($data->period . ' | ' . $rank3SD . ' | ' . $rank3SDCount . ' | ' . $data->time);
                    $rank3SDCount++;
                } else {
                    if (! isset($rank3SDArray[$rank3SDCount])) {
                        $rank3SDArray[$rank3SDCount] = 1;
                    } else {
                        $rank3SDArray[$rank3SDCount] = $rank3SDArray[$rank3SDCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank3SD . ' | ' . $rank3SDCount . ' | ' . $data->time);
                    $rank3SDCount = 1;
                }

                if ($rank4SD == $this->SD($data->rank_4)) {
//                $this->line($data->period . ' | ' . $rank4SD . ' | ' . $rank4SDCount . ' | ' . $data->time);
                    $rank4SDCount++;
                } else {
                    if (! isset($rank4SDArray[$rank4SDCount])) {
                        $rank4SDArray[$rank4SDCount] = 1;
                    } else {
                        $rank4SDArray[$rank4SDCount] = $rank4SDArray[$rank4SDCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank4SD . ' | ' . $rank4SDCount . ' | ' . $data->time);
                    $rank4SDCount = 1;
                }

                if ($rank5SD == $this->SD($data->rank_5)) {
//                $this->line($data->period . ' | ' . $rank5SD . ' | ' . $rank5SDCount . ' | ' . $data->time);
                    $rank5SDCount++;
                } else {
                    if (! isset($rank5SDArray[$rank5SDCount])) {
                        $rank5SDArray[$rank5SDCount] = 1;
                    } else {
                        $rank5SDArray[$rank5SDCount] = $rank5SDArray[$rank5SDCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank5SD . ' | ' . $rank5SDCount . ' | ' . $data->time);
                    $rank5SDCount = 1;
                }

                if ($rank6SD == $this->SD($data->rank_6)) {
//                $this->line($data->period . ' | ' . $rank6SD . ' | ' . $rank6SDCount . ' | ' . $data->time);
                    $rank6SDCount++;
                } else {
                    if (! isset($rank6SDArray[$rank6SDCount])) {
                        $rank6SDArray[$rank6SDCount] = 1;
                    } else {
                        $rank6SDArray[$rank6SDCount] = $rank6SDArray[$rank6SDCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank6SD . ' | ' . $rank6SDCount . ' | ' . $data->time);
                    $rank6SDCount = 1;
                }

                if ($rank7SD == $this->SD($data->rank_7)) {
//                $this->line($data->period . ' | ' . $rank7SD . ' | ' . $rank7SDCount . ' | ' . $data->time);
                    $rank7SDCount++;
                } else {
                    if (! isset($rank7SDArray[$rank7SDCount])) {
                        $rank7SDArray[$rank7SDCount] = 1;
                    } else {
                        $rank7SDArray[$rank7SDCount] = $rank7SDArray[$rank7SDCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank7SD . ' | ' . $rank7SDCount . ' | ' . $data->time);
                    $rank7SDCount = 1;
                }

                if ($rank8SD == $this->SD($data->rank_8)) {
//                $this->line($data->period . ' | ' . $rank8SD . ' | ' . $rank8SDCount . ' | ' . $data->time);
                    $rank8SDCount++;
                } else {
                    if (! isset($rank8SDArray[$rank8SDCount])) {
                        $rank8SDArray[$rank8SDCount] = 1;
                    } else {
                        $rank8SDArray[$rank8SDCount] = $rank8SDArray[$rank8SDCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank8SD . ' | ' . $rank8SDCount . ' | ' . $data->time);
                    $rank8SDCount = 1;
                }

                if ($rank9SD == $this->SD($data->rank_9)) {
//                $this->line($data->period . ' | ' . $rank9SD . ' | ' . $rank9SDCount . ' | ' . $data->time);
                    $rank9SDCount++;
                } else {
                    if (! isset($rank9SDArray[$rank9SDCount])) {
                        $rank9SDArray[$rank9SDCount] = 1;
                    } else {
                        $rank9SDArray[$rank9SDCount] = $rank9SDArray[$rank9SDCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank9SD . ' | ' . $rank9SDCount . ' | ' . $data->time);
                    $rank9SDCount = 1;
                }

                if ($rank10SD == $this->SD($data->rank_10)) {
//                $this->line($data->period . ' | ' . $rank10SD . ' | ' . $rank10SDCount . ' | ' . $data->time);
                    $rank10SDCount++;
                } else {
                    if (! isset($rank10SDArray[$rank10SDCount])) {
                        $rank10SDArray[$rank10SDCount] = 1;
                    } else {
                        $rank10SDArray[$rank10SDCount] = $rank10SDArray[$rank10SDCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $rank10SD . ' | ' . $rank10SDCount . ' | ' . $data->time);
                    $rank10SDCount = 1;
                }

                if ($sumBS == $data->sum_bs) {
//                $this->line($data->period . ' | ' . $sumBS . ' | ' . $sumBSCount . ' | ' . $data->time);
                    $sumBSCount++;
                } else {
                    if (! isset($sumBSArray[$sumBSCount])) {
                        $sumBSArray[$sumBSCount] = 1;
                    } else {
                        $sumBSArray[$sumBSCount] = $sumBSArray[$sumBSCount] + 1;
                    }
//                $this->line($data->period . ' | ' . $sumBS . ' | ' . $sumBSCount . ' | ' . $data->time);
                    $sumBSCount = 1;
                }

                if ($sumSD == $data->sum_sd) {
                    $sumSDCount++;
//                $this->line($data->period . ' | ' . $data->sum_sd . ' | ' . $sumSDCount . ' | ' . $data->time);
                } else {
                    if (! isset($sumSDArray[$sumSDCount])) {
                        $sumSDArray[$sumSDCount] = 1;
                    } else {
                        $sumSDArray[$sumSDCount] = $sumSDArray[$sumSDCount] + 1;
                    }
                    $sumSDCount = 1;
//                $this->line($data->period . ' | ' . $data->sum_sd . ' | ' . $sumSDCount . ' | ' . $data->time);
                }


                if ($animal1 == $data->animal_1) {
                    $animal1Count++;
//                $this->line($data->period . ' | ' . $data->animal_1 . ' | ' . $animal1Count . ' | ' . $data->time);
                } else {
                    if (! isset($animal1Array[$animal1Count])) {
                        $animal1Array[$animal1Count] = 1;
                    } else {
                        $animal1Array[$animal1Count] = $animal1Array[$animal1Count] + 1;
                    }
                    $animal1Count = 1;
//                $this->line($data->period . ' | ' . $data->animal_1 . ' | ' . $animal1Count . ' | ' . $data->time);
                }


                if ($animal2 == $data->animal_2) {
                    $animal2Count++;
//                $this->line($data->period . ' | ' . $data->animal_2 . ' | ' . $animal2Count . ' | ' . $data->time);
                } else {
                    if (! isset($animal2Array[$animal2Count])) {
                        $animal2Array[$animal2Count] = 1;
                    } else {
                        $animal2Array[$animal2Count] = $animal2Array[$animal2Count] + 1;
                    }
                    $animal2Count = 1;
//                $this->line($data->period . ' | ' . $data->animal_2 . ' | ' . $animal2Count . ' | ' . $data->time);
                }

                if ($animal3 == $data->animal_3) {
                    $animal3Count++;
//                $this->line($data->period . ' | ' . $data->animal_3 . ' | ' . $animal3Count . ' | ' . $data->time);
                } else {
                    if (! isset($animal3Array[$animal3Count])) {
                        $animal3Array[$animal3Count] = 1;
                    } else {
                        $animal3Array[$animal3Count] = $animal3Array[$animal3Count] + 1;
                    }
                    $animal3Count = 1;
//                $this->line($data->period . ' | ' . $data->animal_3 . ' | ' . $animal3Count . ' | ' . $data->time);
                }

                if ($animal4 == $data->animal_4) {
                    $animal4Count++;
//                $this->line($data->period . ' | ' . $data->animal_4 . ' | ' . $animal4Count . ' | ' . $data->time);
                } else {
                    if (! isset($animal4Array[$animal4Count])) {
                        $animal4Array[$animal4Count] = 1;
                    } else {
                        $animal4Array[$animal4Count] = $animal4Array[$animal4Count] + 1;
                    }
                    $animal4Count = 1;
//                $this->line($data->period . ' | ' . $data->animal_4 . ' | ' . $animal4Count . ' | ' . $data->time);
                }

                if ($animal5 == $data->animal_5) {
                    $animal5Count++;
//                $this->line($data->period . ' | ' . $data->animal_5 . ' | ' . $animal5Count . ' | ' . $data->time);
                } else {
                    if (! isset($animal5Array[$animal5Count])) {
                        $animal5Array[$animal5Count] = 1;
                    } else {
                        $animal5Array[$animal5Count] = $animal5Array[$animal5Count] + 1;
                    }
                    $animal5Count = 1;
//                $this->line($data->period . ' | ' . $data->animal_5 . ' | ' . $animal5Count . ' | ' . $data->time);
                }


                $rank1BS  = $this->BS($data->rank_1);
                $rank2BS  = $this->BS($data->rank_2);
                $rank3BS  = $this->BS($data->rank_3);
                $rank4BS  = $this->BS($data->rank_4);
                $rank5BS  = $this->BS($data->rank_5);
                $rank6BS  = $this->BS($data->rank_6);
                $rank7BS  = $this->BS($data->rank_7);
                $rank8BS  = $this->BS($data->rank_8);
                $rank9BS  = $this->BS($data->rank_9);
                $rank10BS = $this->BS($data->rank_10);
                $rank1SD  = $this->SD($data->rank_1);
                $rank2SD  = $this->SD($data->rank_2);
                $rank3SD  = $this->SD($data->rank_3);
                $rank4SD  = $this->SD($data->rank_4);
                $rank5SD  = $this->SD($data->rank_5);
                $rank6SD  = $this->SD($data->rank_6);
                $rank7SD  = $this->SD($data->rank_7);
                $rank8SD  = $this->SD($data->rank_8);
                $rank9SD  = $this->SD($data->rank_9);
                $rank10SD = $this->SD($data->rank_10);
                $sumBS    = $data->sum_bs;
                $sumSD    = $data->sum_sd;
                $animal1  = $data->animal_1;
                $animal2  = $data->animal_2;
                $animal3  = $data->animal_3;
                $animal4  = $data->animal_4;
                $animal5  = $data->animal_5;
            }

            $rank1BSCount >= $targetNumber ? $this->notifySlack('冠軍 大小', $rank1BSCount) : null;
            $rank2BSCount >= $targetNumber ? $this->notifySlack('亞軍大小', $rank2BSCount) : null;
            $rank3BSCount >= $targetNumber ? $this->notifySlack('三名 大小', $rank3BSCount) : null;
            $rank4BSCount >= $targetNumber ? $this->notifySlack('四名 大小', $rank4BSCount) : null;
            $rank5BSCount >= $targetNumber ? $this->notifySlack('五名 大小', $rank5BSCount) : null;
            $rank6BSCount >= $targetNumber ? $this->notifySlack('六名 大小', $rank6BSCount) : null;
            $rank7BSCount >= $targetNumber ? $this->notifySlack('七名 大小', $rank7BSCount) : null;
            $rank8BSCount >= $targetNumber ? $this->notifySlack('八名 大小', $rank8BSCount) : null;
            $rank9BSCount >= $targetNumber ? $this->notifySlack('九名 大小', $rank9BSCount) : null;
            $rank10BSCount >= $targetNumber ? $this->notifySlack('十名 大小', $rank10BSCount) : null;
            $rank1SDCount >= $targetNumber ? $this->notifySlack('冠軍 單雙', $rank1SDCount) : null;
            $rank2SDCount >= $targetNumber ? $this->notifySlack('亞軍 單雙', $rank2SDCount) : null;
            $rank3SDCount >= $targetNumber ? $this->notifySlack('三名 單雙', $rank3SDCount) : null;
            $rank4SDCount >= $targetNumber ? $this->notifySlack('四名 單雙', $rank4SDCount) : null;
            $rank5SDCount >= $targetNumber ? $this->notifySlack('五名 單雙', $rank5SDCount) : null;
            $rank6SDCount >= $targetNumber ? $this->notifySlack('六名 單雙', $rank6SDCount) : null;
            $rank7SDCount >= $targetNumber ? $this->notifySlack('七名 單雙', $rank7SDCount) : null;
            $rank8SDCount >= $targetNumber ? $this->notifySlack('八名 單雙', $rank8SDCount) : null;
            $rank9SDCount >= $targetNumber ? $this->notifySlack('九名 單雙', $rank9SDCount) : null;
            $rank10SDCount >= $targetNumber ? $this->notifySlack('十名 單雙', $rank10SDCount) : null;
            $sumBSCount >= $targetNumber ? $this->notifySlack('冠亞合 大小', $sumBSCount) : null;
            $sumSDCount >= $targetNumber ? $this->notifySlack('冠亞合 單雙', $sumSDCount) : null;
            $animal1Count >= $targetNumber ? $this->notifySlack('冠軍獸', $animal1Count) : null;
            $animal2Count >= $targetNumber ? $this->notifySlack('亞軍獸', $animal2Count) : null;
            $animal3Count >= $targetNumber ? $this->notifySlack('三名獸', $animal3Count) : null;
            $animal4Count >= $targetNumber ? $this->notifySlack('四名獸', $animal4Count) : null;
            $animal5Count >= $targetNumber ? $this->notifySlack('五名獸', $animal5Count) : null;
//            app(SlackNotify::class)->setMsg("--------------------------------------")->notify();

            $i--;
            sleep(1);
        }
        $this->result('冠軍大小：', $rank1BSArray);
        $this->result('亞軍大小：', $rank2BSArray);
        $this->result('三名大小：', $rank3BSArray);
        $this->result('四名大小：', $rank4BSArray);
        $this->result('五名大小：', $rank5BSArray);
        $this->result('六名大小：', $rank6BSArray);
        $this->result('七名大小：', $rank7BSArray);
        $this->result('八名大小：', $rank8BSArray);
        $this->result('九名大小：', $rank9BSArray);
        $this->result('十名大小：', $rank10BSArray);

        $this->result('冠軍單雙：', $rank1SDArray);
        $this->result('亞軍單雙：', $rank2SDArray);
        $this->result('三名單雙：', $rank3SDArray);
        $this->result('四名單雙：', $rank4SDArray);
        $this->result('五名單雙：', $rank5SDArray);
        $this->result('六名單雙：', $rank6SDArray);
        $this->result('七名單雙：', $rank7SDArray);
        $this->result('八名單雙：', $rank8SDArray);
        $this->result('九名單雙：', $rank9SDArray);
        $this->result('十名單雙：', $rank10SDArray);

        $this->result('冠亞大小：', $sumBSArray);
        $this->result('冠亞單雙：', $sumSDArray);

        $this->result('冠軍獸：', $animal1Array);
        $this->result('亞軍獸：', $animal2Array);
        $this->result('三名獸：', $animal3Array);
        $this->result('四名獸：', $animal4Array);
        $this->result('五名獸：', $animal5Array);


    }

    public function notifySlack($msg, $count)
    {
        app(SlackNotify::class)->setMsg("極速飛艇 $msg $count 連")->notify();
    }

    public function SD($number)
    {
        return $number % 2 ? '單' : '雙';
    }

    public function BS($number)
    {
        return $number <= 5 ? '小' : '大';
    }

    public function result($word, $array)
    {
        ksort($array);
        unset($array[1]);
        unset($array[2]);
        unset($array[3]);
        unset($array[4]);
        unset($array[5]);
        unset($array[6]);
        unset($array[7]);
        unset($array[8]);
//        unset($array[9]);
//        unset($array[10]);
//        unset($array[11]);
//        unset($array[8]);
        foreach ($array as $key => $value) {
            $word .= "$key-$value / ";
        }
        $this->line($word);
    }
}
