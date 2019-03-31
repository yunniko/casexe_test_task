<?php

namespace app\models\ActiveRecord;

use app\interfaces\PrizeARInterface;
use Yii;

/**
 * This is the model class for table "objects".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property double $weight
 */
class Objects extends \yii\db\ActiveRecord implements PrizeARInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'objects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['weight'], 'number'],
            [['name', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'weight' => 'Weight',
        ];
    }


    public static function getPrizeType()
    {
        return 'object';
    }
}
