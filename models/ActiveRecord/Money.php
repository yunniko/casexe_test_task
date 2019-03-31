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
}
