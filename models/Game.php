<?php
/**
 * Created by PhpStorm.
 * User: Vaara
 * Date: 31.03.2019
 * Time: 16:38
 */

namespace app\models;

use app\interfaces\PrizePoolInterface;
use app\interfaces\PrizeRecipientInterface;

class Game {
    private $_prizeGenerators = [];

    private function generate(){
        $generator = $this->getRandomPrizeGenerator();
        $prize = null;
        if($generator !== null) {
            $prize = $generator->getRandom();
        }
        return $prize;
    }

    public function registerPrizeGenerator(PrizePoolInterface $prize) {
        if (!in_array($prize, $this->_prizeGenerators)) $this->_prizeGenerators[] = $prize;
        return $this;
    }

    private function getPrizeGenerators() {
        $result = [];
        foreach ($this->_prizeGenerators as $generator) {
            if ($generator->isAvailable()) $result[] = $generator;
        }
        return $result;
    }

    private function getRandomPrizeGenerator() {
        $generators = $this->getPrizeGenerators();
        $count = count($generators);
        $result = null;
        if($count > 0) {
            $n = mt_rand(0, $count - 1);
            $result = $generators[$n];
        }
        return $result;
    }

    public function start(PrizeRecipientInterface $gamer) {
        $prize = $this->generate();
        $prize->assignTo($gamer);
        return $prize;
    }

}