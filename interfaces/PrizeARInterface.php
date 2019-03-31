<?php
/**
 * Created by PhpStorm.
 * User: Vaara
 * Date: 31.03.2019
 * Time: 18:41
 */

namespace app\interfaces;

interface PrizeARInterface {
    public static function getPrizeType();
    public function accept(PrizeRecipientInterface $recepient);
    public function decline(PrizeRecipientInterface $recepient);
    public function send(PrizeRecipientInterface $recepient);
}