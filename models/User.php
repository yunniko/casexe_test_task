<?php

namespace app\models;

use app\interfaces\PrizeRecipientInterface;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface, PrizeRecipientInterface
{
    public $password = 'password';


    public static function tableName()
    {
        return 'users';
    }
    public function rules()
    {
        return [
            [['bonuses', 'money'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['name' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function addBonus($value) {
        $this->bonuses += $value;
        return $this->updateAttributes(['bonuses']);
    }
    public function addMoney($value) {
        $this->money += $value;
        return $this->updateAttributes(['money']);
    }

    public function getWinsAssignedDataset() {
        return $this->hasMany(\app\models\ActiveRecord\Wins::class, ['recipient_id' => 'id'])->andOnCondition(['status' => 'assigned']);
    }

    public function getAllowedGain() {
        $result = [];
        foreach ($this->winsAssignedDataset as $win) {
            $result[] = $win->getModel();
        }
        return $result;
    }
}
