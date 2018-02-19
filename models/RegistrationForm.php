<?php
/**
 * Created by PhpStorm.
 * User: Dashok
 * Date: 19.02.2018
 * Time: 14:14
 */

namespace app\models;
use Yii;
use yii\base\Model;

class RegistrationForm extends Model
{
   public $name;
   public $surname;
    public $username;
    public $password;
    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['name', 'required'],
            ['surname', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 20],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {

        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }

}