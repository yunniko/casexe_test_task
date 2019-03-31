<?php
/**
 * Created by PhpStorm.
 * User: Vaara
 * Date: 31.03.2019
 * Time: 16:20
 */

namespace app\interfaces;

interface PrizeRecipientInterface{
    public function addBonus($value);
    public function addMoney($value);
}
