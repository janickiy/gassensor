<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\base\Model;

class UserForm extends Model
{
    public $name;
    public $phone;
    public $username;
    public $email;
    public $password;
    public $role;

    public function rules(): array
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],

            ['phone', 'trim'],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['name', 'string', 'min' => 2, 'max' => 255],
            ['phone', 'string'],

            ['role', 'string'],
            ['role', 'required'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function save(): ?bool
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $result = $user->save();

        if ($result) {
            $userId = $user->getId();
            $auth = Yii::$app->authManager;
            $auth->revokeAll($userId);
            $userRole = $auth->getRole($this->role);
            $auth->assign($userRole, $userId);
        }

        return $result;
    }

    public function attributeLabels()
    {
        return [
            'name' => 'ФИО',
            'phone' => 'Телефон',
            'username' => 'Логин',
            'email' => 'E-mail',
            'role' => 'Роль',
        ];
    }
}