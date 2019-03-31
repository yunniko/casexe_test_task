<?php

namespace app\models\ActiveRecord;

use app\interfaces\PrizeARInterface;
use app\interfaces\PrizeRecipientInterface;
use Yii;

/**
 * This is the model class for table "bonuses".
 *
 * @property string $id
 * @property int $value
 */
class Bonuses extends \yii\db\ActiveRecord implements PrizeARInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bonuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value'], 'integer'],
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
        ];
    }

    public static function getPrizeType()
    {
        return 'bonus';
    }

    public static function create($value) {
        $object = new static();
        $object->setAttribute('value', $value);
        if($object->save()) return $object;
        return null;
    }

    public function accept(PrizeRecipientInterface $recepient) {
        return true;
    }
    public function decline(PrizeRecipientInterface $recepient) {
        return true;
    }
    public function send(PrizeRecipientInterface $recepient) {
        return true;
    }
}
