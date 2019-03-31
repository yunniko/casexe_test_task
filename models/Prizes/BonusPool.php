<?php
/**
 * Created by PhpStorm.
 * User: Vaara
 * Date: 31.03.2019
 * Time: 16:05
 */

namespace app\models\prizes;


use app\interfaces\PrizePoolInterface;

class BonusPool implements PrizePoolInterface {
    public function isAvailable()
    {
        return true;
    }

    public function getRandom() {
        return Bonus::create(mt_rand($this->getMin(), $this->getMax()));
    }

    private function getMin() {
        return 10;
    }

    private function getMax() {
        return 100;
    }
}