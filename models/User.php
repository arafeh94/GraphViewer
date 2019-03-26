<?php

namespace app\models;

use app\components\rbac\RbacInterface;
use app\components\Tools;
use Yii;
use yii\db\ActiveRecord;

/**
 * Class User
 * @property int id
 * @property string username
 * @property string password
 * @property int role
 * @property string created_at
 * @package app\models
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface,RbacInterface
{
    /**
     * @return User
     */
    public static function get()
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return Yii::$app->user->identity;
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return true;
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

    /**
     * @return int|string
     */
    function getRole()
    {
        return $this->role == 1 ? "admin" : "user";
    }
}
