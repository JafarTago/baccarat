<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\Table;

class martingale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mt';

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
        $錢包      = 5000;
        $每次帶入金額  = 5000;
        $投注額     = 10;
        $模擬次數    = 1;
        $停把次數    = 6;
        $開始把數    = 20;
        $莊比閒多的次數 = 5;
        $停止局數    = 70;
        $馬丁順序    = [
            1 => '莊',
            2 => '莊',
            3 => '閒',
            4 => '莊',
            5 => '閒',
            6 => '閒',
            7 => '莊',
            8 => '莊',
        ];
        $馬丁金額    = [
            1 => 10,
            2 => 20,
            3 => 40,
            4 => 80,
            5 => 160,
            6 => 320,
            7 => 640,
            8 => 1280,
        ];

        $排列組合位置 = 0;
        for ($執行次數 = 0; $執行次數 < $模擬次數; $執行次數++) {
            $資本   = $每次帶入金額;
            $錢包   -= $每次帶入金額; // 可能用不到
            $馬丁次數 = 1;
            $排列組合 = [];

            $pokers = [
                'b11', 'b12', 'b13', 'b14', 'b15', 'b16', 'b17', 'b18', 'b19', 'b10', 'b1j0', 'b1q0', 'b1k0',
                'r11', 'r12', 'r13', 'r14', 'r15', 'r16', 'r17', 'r18', 'r19', 'r10', 'r1j0', 'r1q0', 'r1k0',
                'f11', 'f12', 'f13', 'f14', 'f15', 'f16', 'f17', 'f18', 'f19', 'f10', 'f1j0', 'f1q0', 'f1k0',
                'c11', 'c12', 'c13', 'c14', 'c15', 'c16', 'c17', 'c18', 'c19', 'c10', 'c1j0', 'c1q0', 'c1k0',
                'b21', 'b22', 'b23', 'b24', 'b25', 'b26', 'b27', 'b28', 'b29', 'b20', 'b2j0', 'b2q0', 'b2k0',
                'r21', 'r22', 'r23', 'r24', 'r25', 'r26', 'r27', 'r28', 'r29', 'r20', 'r2j0', 'r2q0', 'r2k0',
                'f21', 'f22', 'f23', 'f24', 'f25', 'f26', 'f27', 'f28', 'f29', 'f20', 'f2j0', 'f2q0', 'f2k0',
                'c21', 'c22', 'c23', 'c24', 'c25', 'c26', 'c27', 'c28', 'c29', 'c20', 'c2j0', 'c2q0', 'c2k0',
                'b31', 'b32', 'b33', 'b34', 'b35', 'b36', 'b37', 'b38', 'b39', 'b30', 'b3j0', 'b3q0', 'b3k0',
                'r31', 'r32', 'r33', 'r34', 'r35', 'r36', 'r37', 'r38', 'r39', 'r30', 'r3j0', 'r3q0', 'r3k0',
                'f31', 'f32', 'f33', 'f34', 'f35', 'f36', 'f37', 'f38', 'f39', 'f30', 'f3j0', 'f3q0', 'f3k0',
                'c31', 'c32', 'c33', 'c34', 'c35', 'c36', 'c37', 'c38', 'c39', 'c30', 'c3j0', 'c3q0', 'c3k0',
                'b41', 'b42', 'b43', 'b44', 'b45', 'b46', 'b47', 'b48', 'b49', 'b40', 'b4j0', 'b4q0', 'b4k0',
                'r41', 'r42', 'r43', 'r44', 'r45', 'r46', 'r47', 'r48', 'r49', 'r40', 'r4j0', 'r4q0', 'r4k0',
                'f41', 'f42', 'f43', 'f44', 'f45', 'f46', 'f47', 'f48', 'f49', 'f40', 'f4j0', 'f4q0', 'f4k0',
                'c41', 'c42', 'c43', 'c44', 'c45', 'c46', 'c47', 'c48', 'c49', 'c40', 'c4j0', 'c4q0', 'c4k0',
                'b51', 'b52', 'b53', 'b54', 'b55', 'b56', 'b57', 'b58', 'b59', 'b50', 'b5j0', 'b5q0', 'b5k0',
                'r51', 'r52', 'r53', 'r54', 'r55', 'r56', 'r57', 'r58', 'r59', 'r50', 'r5j0', 'r5q0', 'r5k0',
                'f51', 'f52', 'f53', 'f54', 'f55', 'f56', 'f57', 'f58', 'f59', 'f50', 'f5j0', 'f5q0', 'f5k0',
                'c51', 'c52', 'c53', 'c54', 'c55', 'c56', 'c57', 'c58', 'c59', 'c50', 'c5j0', 'c5q0', 'c5k0',
                'b61', 'b62', 'b63', 'b64', 'b65', 'b66', 'b67', 'b68', 'b69', 'b60', 'b6j0', 'b6q0', 'b6k0',
                'r61', 'r62', 'r63', 'r64', 'r65', 'r66', 'r67', 'r68', 'r69', 'r60', 'r6j0', 'r6q0', 'r6k0',
                'f61', 'f62', 'f63', 'f64', 'f65', 'f66', 'f67', 'f68', 'f69', 'f60', 'f6j0', 'f6q0', 'f6k0',
                'c61', 'c62', 'c63', 'c64', 'c65', 'c66', 'c67', 'c68', 'c69', 'c60', 'c6j0', 'c6q0', 'c6k0',
                'b71', 'b72', 'b73', 'b74', 'b75', 'b76', 'b77', 'b78', 'b79', 'b70', 'b7j0', 'b7q0', 'b7k0',
                'r71', 'r72', 'r73', 'r74', 'r75', 'r76', 'r77', 'r78', 'r79', 'r70', 'r7j0', 'r7q0', 'r7k0',
                'f71', 'f72', 'f73', 'f74', 'f75', 'f76', 'f77', 'f78', 'f79', 'f70', 'f7j0', 'f7q0', 'f7k0',
                'c71', 'c72', 'c73', 'c74', 'c75', 'c76', 'c77', 'c78', 'c79', 'c70', 'c7j0', 'c7q0', 'c7k0',
                'b81', 'b82', 'b83', 'b84', 'b85', 'b86', 'b87', 'b88', 'b89', 'b80', 'b8j0', 'b8q0', 'b8k0',
                'r81', 'r82', 'r83', 'r84', 'r85', 'r86', 'r87', 'r88', 'r89', 'r80', 'r8j0', 'r8q0', 'r8k0',
                'f81', 'f82', 'f83', 'f84', 'f85', 'f86', 'f87', 'f88', 'f89', 'f80', 'f8j0', 'f8q0', 'f8k0',
                'c81', 'c82', 'c83', 'c84', 'c85', 'c86', 'c87', 'c88', 'c89', 'c80', 'c8j0', 'c8q0', 'c8k0',
            ];

            shuffle($pokers);
            $剔除張數 = substr(array_shift($pokers), -1);

            if ($剔除張數 == 0) {
                $剔除張數 = 10;
            }

            while ($剔除張數 > 0) {
                array_shift($pokers);
                $剔除張數--;
            }

            $上局結果 = '';

            for ($局數 = 1; $局數 <= $停止局數; $局數++) {

                if ($馬丁次數 > $停把次數) {
                    $馬丁次數 = 1;
                }

                $投注額 = $馬丁金額[$馬丁次數];  //投注後扣款
                $資本  -= $投注額;

                $playerOneCard   = substr(array_shift($pokers), -1);
                $bankerOneCard   = substr(array_shift($pokers), -1);
                $playerTwoCard   = substr(array_shift($pokers), -1);
                $bankerTwoCard   = substr(array_shift($pokers), -1);
                $playerThreeCard = ' ';
                $bankerThreeCard = ' ';

                $playerNumber = substr($playerOneCard + $playerTwoCard, -1);
                $bankerNumber = substr($bankerOneCard + $bankerTwoCard, -1);

                if ($playerNumber < 8) { // 天牌不補牌
                    if ($bankerNumber < 8) {

                        if ($playerNumber < 6) { // 閒家補牌
                            $playerThreeCard = substr(array_shift($pokers), -1);
                            $playerNumber    = substr($playerNumber + $playerThreeCard, -1);
                        }

                        switch ($bankerNumber) {
                            case 0:
                                $bankerThreeCard = substr(array_shift($pokers), -1);
                                $bankerNumber    = substr($bankerNumber + $bankerThreeCard, -1);
                                break;

                            case 1:
                                $bankerThreeCard = substr(array_shift($pokers), -1);
                                $bankerNumber    = substr($bankerNumber + $bankerThreeCard, -1);
                                break;

                            case 2:
                                $bankerThreeCard = substr(array_shift($pokers), -1);
                                $bankerNumber    = substr($bankerNumber + $bankerThreeCard, -1);
                                break;

                            case 3:
                                $bankerThreeCard = substr(array_shift($pokers), -1);
                                if ($playerThreeCard <> 8) {
                                    $bankerNumber = substr($bankerNumber + $bankerThreeCard, -1);
                                }
                                break;

                            case 4:
                                $bankerThreeCard = substr(array_shift($pokers), -1);
                                if ($playerThreeCard <> 1 || $playerThreeCard <> 8 || $playerThreeCard <> 9 || $playerThreeCard <> 0) {
                                    $bankerNumber = substr($bankerNumber + $bankerThreeCard, -1);
                                }
                                break;

                            case 5:
                                $bankerThreeCard = substr(array_shift($pokers), -1);
                                if ($playerThreeCard <> 1 || $playerThreeCard <> 2 || $playerThreeCard <> 3 || $playerThreeCard <> 8 || $playerThreeCard <> 9 || $playerThreeCard <> 0) {
                                    $bankerNumber = substr($bankerNumber + $bankerThreeCard, -1);
                                }
                                break;

                            case 6:
                                $bankerThreeCard = substr(array_shift($pokers), -1);
                                if ($playerThreeCard == 6 || $playerThreeCard == 7) {
                                    $bankerNumber = substr($bankerNumber + $bankerThreeCard, -1);
                                }
                                break;
                        }
                    }
                }
//

                if ($playerNumber == $bankerNumber) {
                    $開局結果 = '平';
                } else if ($playerNumber > $bankerNumber) {
                    $開局結果 = '閒';
                } else {
                    $開局結果 = '莊';
                }

                if ($開局結果 == '平') {
                    $返還金額 = '+0元';
                    $資本  += $投注額;
                    $輸贏   = ' ';
                } else {
                    if ($馬丁順序[$馬丁次數] == $開局結果) {
                        $資本   += $馬丁金額[$馬丁次數] * 2;
                        $輸贏   = '<fg=red>✔</>';
                        $返還金額 = '+' . $投注額 . '元';
                    } else {
                        $輸贏   = ' ';
                        $返還金額 = '-' . $投注額 . '元';
                    }
                }


                $this->line('閒：' . $playerNumber . '點 - ' . $playerOneCard . ' ' . $playerTwoCard . ' ' . $playerThreeCard . ' | ' .
                    '莊：' . $bankerNumber . '點 - ' . $bankerOneCard . ' ' . $bankerTwoCard . ' ' . $bankerThreeCard . ' | 結果：' . $開局結果 .
                    ' | 資本：' . $資本 . ' ' . $返還金額 . ' ' . $輸贏 . '   ' . '馬丁次數：' . $馬丁次數);

                // 配合結果的hot code 寫法
                if ($開局結果 <> '平') {
                    if ($馬丁順序[$馬丁次數] == $開局結果) {
                        $馬丁次數 = 1; // 回到第一關
                    } else {
                        $馬丁次數++;
                    }
                }

                if (empty($上局結果)) {
                    $上局結果 = $開局結果;
                }

                switch ($開局結果) {
                    case '平':
                        $排列組合[$排列組合位置][] = '<fg=green>平</>';
                        break;
                    case '閒':

                        if ($開局結果 <> $上局結果) {
                            $排列組合位置++;
                        }
                        $排列組合[$排列組合位置][] = '<fg=blue>閒</>';
                        break;
                    case '莊':

                        if ($開局結果 <> $上局結果) {
                            $排列組合位置++;
                        }
                        $排列組合[$排列組合位置][] = '<fg=red>莊</>';
                        break;
                }

                $上局結果 = $開局結果;

            }

            $反轉排列組合 = [];
            for ($i = 0; $i < 15; $i++) {
                foreach ($排列組合 as $v) {
                    if (isset($v[$i])) {
                        $反轉排列組合[$i][] = $v[$i];
                    } else {
                        $反轉排列組合[$i][] = ' ';
                    }
                }
            }
//
            $table = new Table($this->output);

            $table->setRows($反轉排列組合);

            $table->render();
        }

        // 首局抽牌，最多十張踢除
        // 停損點、獲利點
    }
}


// 驗證程式反轉前的結果
//        foreach ($排列組合 as $l1array) {
//            foreach ($l1array as $v) {
//                echo $v . ' ';
//            }
//            echo "\n";
//        }

//            $tmp = '';
//            foreach ($反轉排列組合 as $l1array) {
//                foreach ($l1array as $v) {
//                    $tmp .= $v;
//                }
//                $this->line($tmp);
//                $tmp = '';
//            }


//if ($playerNumber == $bankerNumber) {

//    $排列組合[$排列組合位置][] = 'T';
//    $資本 += $下注額 * $馬丁次數;
//    echo '平';
//} else if ($playerNumber > $bankerNumber) {
//    echo '閒';
//    $開局結果 = '閒';
//    if ($上局結果 <> '閒') {
//        $上局結果 = '閒';
////                        $排列組合位置++;
//    }
//
//    if ($下注對象 == $上局結果) {
//        $資本 += $下注額 * 2;
//        $馬丁次數 = 1;
//        $排列組合[$排列組合位置][] = '<fg=red>P</>';
//    } else {
//        $排列組合[$排列組合位置][] = '閒';
//        $馬丁次數++;
//    }
//
//} else {
//    echo '莊';
//    if ($上局結果 <> '莊') {
//        $上局結果 = '莊';
////                        $排列組合位置++;
//    }
//
//    if ($下注對象 == $上局結果) {
//        $資本 += $下注額 * 2;
//        $馬丁次數 = 1;
//        $排列組合[$排列組合位置][] = '<fg=red>B</>';
//    } else {
//        $排列組合[$排列組合位置][] = '莊';
//        $馬丁次數++;
//    }
