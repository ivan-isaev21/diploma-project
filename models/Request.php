<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property int $id Номер заказа
 * @property string $name Имя заказавшего
 * @property string $text Текст заказа
 * @property string|null $email E-mail
 * @property string $phone_number Номер телефона
 */
class Request extends \yii\db\ActiveRecord
{
   public $verifyCode;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text', 'phone_number'], 'required'],
            [['text'], 'string','max'=>2000],
            [['name'], 'string', 'max' => 255],
            [['email'],'email'],
            [['phone_number'], 'string', 'max' => 12],
            ['verifyCode', 'captcha']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер заказа',
            'name' => 'Имя',
            'text' => 'Примечание',
            'email' => 'E-mail',
            'phone_number' => 'Номер телефона',
            'verifyCode' =>'Текст с картинки'
        ];
    }
}
