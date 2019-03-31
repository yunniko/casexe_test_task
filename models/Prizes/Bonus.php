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

class Bonus extends Prize {

    public function accept(){
        if ($this->_object->accept()) return $this->_object->send();

        return false;
    }


    public static function create($value) {
        $bonus = Bonuses::create($value);
        return static::get(Wins::create($bonus));
    }

}