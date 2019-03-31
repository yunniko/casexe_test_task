<?php

namespace app\models\ActiveRecord;

use app\interfaces\PrizeARInterface;
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
}
