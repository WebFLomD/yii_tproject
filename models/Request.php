<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $status
 * @property string $message
 * @property string $comment
 * @property string $created_at
 * @property string $updated_at
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'status', 'message'], 'required', 'message' => 'Заполните поля!'],
            [['status', 'message', 'comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Email',
            'status' => 'Статус',
            'message' => 'Сообщение',
            'comment' => 'Комментарии',
            'created_at' => 'Дата публикации',
            'updated_at' => 'Дата обновление',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!$insert) {
                // Если это обновление, устанавливаем текущее время в формате DATETIME
                $this->updated_at = (new \DateTime())->format('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }
}
