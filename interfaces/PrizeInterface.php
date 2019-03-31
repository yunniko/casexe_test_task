<?php
/**
 * Created by PhpStorm.
 * User: Vaara
 * Date: 31.03.2019
 * Time: 15:56
 */

namespace app\interfaces;

interface PrizeInterface{
    public function accept();
    public function isAccepted();
    public function decline();

    public function send();
    public function isSent();

    public function getDescription();
}