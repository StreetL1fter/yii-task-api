<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\models\User;

/**
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property string $updated_at
 * @property string $created_at

 

 */
class Task extends ActiveRecord 
{

    public function behaviors()
    {
        return [
            [
                "class" => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function()
                {
                    return date('Y-m-d H:i:s');
                },
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%tasks}}';
    }


    public function rules(){
        return [
            ['user_id', 'required'],
            ['user_id', 'exist', 'targetClass' => User::class, 'targetAttribute' => 'id'],
            ['title', 'required'],
            ['title', 'string', 'max' => 255],
            ['description', 'required'],
            ['description', 'string'],
            ['status', 'required'],
            ['status', 'string', 'max' => 255],


        ];
    }

    public function attributeLabels()
    {
        return[

        'user_id' => "ID",
        'title' => 'Название задачи',
        'description' => 'Описание',
        'status' => 'Статус',
        'created_at' => 'Дата создания',
        'updated_at' => 'Дата обновления'
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class,['id' => 'user_id']);
    }


}

?>