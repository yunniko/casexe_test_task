<?php

namespace app\models\ActiveRecord;

use app\interfaces\PrizeARInterface;
use app\interfaces\PrizeRecipientInterface;
use Yii;

/**
 * This is the model class for table "money".
 *
 * @property string $id
 * @property int $value
 * @property string $currency
 */
class Money extends \yii\db\ActiveRecord implements PrizeARInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'money';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'integer'],
            [['currency'], 'string', 'max' => 255],
            [['currency'], 'default', 'value' => 'euro']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'currency' => 'Currency',
        ];
    }

    public static function getPrizeType()
    {
        return 'money';
    }

    public function accept(PrizeRecipientInterface $recepient) {
        return true;
    }
    public function decline(PrizeRecipientInterface $recepient) {
        return true;
    }
    public function send(PrizeRecipientInterface $recepient) {
        $recepient->addMoney($this->value);
        return true;
    }
    public static function create($value) {
        $object = new static();
        $object->setAttribute('value', $value);
        if($object->save()) return $object;
        return null;
    }
    public function getDescription() {
        return $this->value !== 1 ? "$this->value {$this->currency}s" : "1 {$this->currency}";
    }
}
