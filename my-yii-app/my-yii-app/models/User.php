<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * @property int $id
 * @property string $username
 * @property string $created_at
 

 */
class User extends ActiveRecord 
{
   
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null,
                'value' => function(){
                    return date("Y-m-d H:i:s");
                },
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */


    public function rules()
    
    {
        return [
            [['username'],'required'],
            ['username','string','min' => 3,'max' => 255],
            
        ];
        

    }

    public function attributeLabels(){
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'created_at' => 'Дата создания',
        ];
    }

    public function getTasks()
    {
        return $this->hasMany(Task::class,['user_id' => 'id']);
    }


}
