<?php
/**
 * Created by PhpStorm.
 * User: Vaara
 * Date: 31.03.2019
 * Time: 16:01
 */

namespace app\interfaces;

interface PrizePullInterface{
    public function getRandom();

    public function isAvailable();
}
