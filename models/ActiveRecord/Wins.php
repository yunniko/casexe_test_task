<?php

namespace app\models\ActiveRecord;

use app\interfaces\PrizeARInterface;
use app\interfaces\PrizeRecipientInterface;
use app\models\prizes\Bonus;
use app\models\prizes\Object;
use app\models\User;
use Yii;

/**
 * This is the model class for table "wins".
 *
 * @property string $id
 * @property string $prize_id
 * @property string $recipient_id
 * @property string $status
 * @property string $prize_type
 */
class Wins extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wins';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prize_id', 'recipient_id'], 'integer'],
            [['status'], 'string'],
            [['prize_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prize_id' => 'Prize ID',
            'recipient_id' => 'Recipient ID',
            'status' => 'Status',
            'prize_type' => 'Prize Type',
        ];
    }

    public function getBonusData() {
        return $this->hasOne(Bonuses::class, ['id' => 'prize_id']);
    }
    public function getMoneyData() {
        return $this->hasOne(Money::class, ['id' => 'prize_id']);
    }
    public function getObjectData() {
        return $this->hasOne(Objects::class, ['id' => 'prize_id']);
    }

    public function getRecipientData() {
        return $this->hasOne(User::class, ['id' => 'recipient_id']);
    }

    public static function create(PrizeARInterface $prize) {
        $result = new static;
        $result->setAttribute('prize_type', get_class($prize)::getPrizeType());
        $result->setAttribute('prize_id', $prize->id);
        $result->save();
        return $result;
    }

    public function getPrizeData() {
        foreach ([
            $this->bonusData,
            $this->moneyData,
            $this->objectData
                 ] as $obj) {
            if ($this->prize_type === $obj->getPrizeType()) return $obj;
        }
        return null;
    }

    public function accept() {
        $this->prizeData->accept($this->recipientData);
        return $this->updateStatus('accepted');
    }
    public function decline() {
        $this->prizeData->decline($this->recipientData);
        return $this->updateStatus('declined');
    }
    public function send() {
        $this->prizeData->send($this->recipientData);
        return $this->updateStatus('sent');
    }

    private function updateStatus($status) {
        $this->setAttribute('status', $status);
        return $this->updateAttributes(['status']);
    }

    public function setRecipient(PrizeRecipientInterface $recipient) {
        $this->setAttributes(['recipient_id' => $recipient->id, 'status' => 'assigned']);
        return $this->updateAttributes(['recipient_id', 'status']);
    }

    public function description() {
        return $this->prizeData->getDescription();
    }

    public function getModel() {
        switch($this->prize_type) {
            case 'bonus': return Bonus::get($this);
            case 'money': return \app\models\prizes\Money::get($this);
            case 'object': return Object::get($this);
            default: return null;
        }
    }
}
