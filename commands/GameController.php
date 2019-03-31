<?php
/**
 * Created by PhpStorm.
 * User: Vaara
 * Date: 31.03.2019
 * Time: 22:08
 */

namespace app\commands;

use app\models\ActiveRecord\Wins;
use yii\console\Controller;
use yii\helpers\Console;

class GameController extends Controller {
    public function actionSendMoney($n) {
        $identificators = Wins::find()->where(['status' => 'accepted'])->select('id')->column();
        $count = count($identificators);
        $identificators = array_chunk($identificators, $n);

        $sent = 0;
        Console::stdout("Start sending money\n");
        foreach ($identificators as $ids) {
            Console::stdout("sending next $n, $sent/$count is already sent\n");
            $wins = Wins::find()->where(['id' => $ids])->all();
            foreach ($wins as $win) {
                if ($win->getModel()->send()) {
                    Console::stdout('.');
                    $sent++;
                }
                else Console::stdout('E');
            }
            Console::stdout("\n");
        }
        Console::stdout("$sent gains were send");
    }
}