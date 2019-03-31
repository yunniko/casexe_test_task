<?php
/**
 * Created by PhpStorm.
 * User: Vaara
 * Date: 31.03.2019
 * Time: 16:05
 */

namespace app\models\prizes;

use app\interfaces\PrizeARInterface;
use app\interfaces\PrizeInterface;
use app\models\ActiveRecord\Bonuses;
use app\models\ActiveRecord\Wins;

class Bonus implements PrizeInterface {

    private $_object;

    public function isAccepted() {
        $this->getObject()->isAcepted;
    }
    public function isDeclined() {
        $this->getObject()->isDeclined;
    }
    public function isSent() {
        $this->getObject()->isSent;
    }

    public function accept(){
        $this->getObject()->accept();
    }
    public function decline(){
        $this->getObject()->decline();
    }

    public function send(){
        $this->getObject()->send();
    }

    public function getDescription(){
        $this->getObject()->name();
    }

    public static function create(Wins $value) {
        $bonus = Bonuses::create($value);
        return static::get(Wins::create($bonus));
    }

    public static function get(Wins $object) {
        $result = new static();
        $result->_object = $object;
        return $result;
    }

    public function getObject() {
        return $this->_object;
    }
}