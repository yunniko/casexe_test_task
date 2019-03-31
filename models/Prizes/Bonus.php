<?php
/**
 * Created by PhpStorm.
 * User: Vaara
 * Date: 31.03.2019
 * Time: 16:05

 * @property \app\models\ActiveRecord\Wins $_object
 */

namespace app\models\prizes;

use app\interfaces\PrizeARInterface;
use app\interfaces\PrizeInterface;
use app\interfaces\PrizeRecipientInterface;
use app\models\ActiveRecord\Bonuses;
use app\models\ActiveRecord\Wins;

class Bonus implements PrizeInterface {

    private $_object;

    public function isAccepted() {
        $this->_object->isAcepted;
    }
    public function isDeclined() {
        $this->_object->isDeclined;
    }
    public function isSent() {
        $this->_object->isSent;
    }

    public function accept(){
        if ($this->_object->accept()) return $this->_object->send();

        return false;
    }
    public function decline(){
        return $this->_object->decline();
    }

    public function send(){
        return $this->_object->send();
    }

    public function getDescription(){
        return $this->_object->description();
    }

    public static function create($value) {
        $bonus = Bonuses::create($value);
        return static::get(Wins::create($bonus));
    }

    public static function get(Wins $object) {
        $result = new static();
        $result->_object = $object;
        return $result;
    }

    public function getId() {
        return $this->_object->id;
    }

    public function assignTo(PrizeRecipientInterface $gamer)
    {
        return $this->_object->setRecipient($gamer);
    }
}