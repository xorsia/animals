<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "animals".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $type
 * @property int|null $age
 * @property int|null $status
 * @property string|null $timestamp
 */
class Animal extends \yii\db\ActiveRecord
{
    const ANIMAL_TYPES = ['cat', 'dog', 'turtle'];
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    public static $giveAwayTimeStamp;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'animals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'age', 'name',], 'required'],
            [['type', 'status', 'timestamp'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'age' => 'Age',
            'status' => 'Status',
            'timestamp' => 'Date',
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->status = self::STATUS_ACTIVE;
            $this->timestamp = strtotime('now');
        }
        return parent::beforeSave($insert);
    }

    public  function giveAway(){
        if($this->status == self::STATUS_INACTIVE){
            return false;
        }
        self::$giveAwayTimeStamp = self::find()->where(['status' => 1, 'type' => $this->type ?? array_keys(self::ANIMAL_TYPES)])->min('timestamp');
        if($this->timestamp == self::$giveAwayTimeStamp){
            $this->status = self::STATUS_INACTIVE;
            self::save();
            return true;
        }else{
            return false;
        }
    }
}
