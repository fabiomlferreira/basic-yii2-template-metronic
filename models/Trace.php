<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\models\user\User;
/**
 * This is the model class for table "trace".
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property int $object_id
 * @property string $message
 * @property string $content
 * @property int $created_at
 * @property int $updated_at
 *
 * @property app\models\user\User $user
 */
class Trace extends \yii\db\ActiveRecord
{
    const TYPE_GENERIC = "generic";

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trace';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['user_id'], 'required'],
            [['user_id', 'object_id', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['type'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 512],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    
    /**
    * Behaviors function, automatically add timestamps to created_at and updated_at
    * @return type
    */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User'),
            'type' => Yii::t('app', 'Type'),
            'object_id' => Yii::t('app', 'Object ID'),
            'message' => Yii::t('app', 'Message'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /**
     * Return an array with the values of type field
     * @return array
     */
    public static function getTypeArray()
    {
        return [
            self::TYPE_GENERIC =>  Yii::t('app', 'Generic'),
        ];
    }
    
    /**
     * Return an array with the values of type field
     * @return array
     */
    public function getTypeOptions()
    {
        return [
            self::TYPE_GENERIC =>  Yii::t('app', 'Generic'),
        ];
    }
    
     /**
     * Return the text of the selected type
     * @return array
     */
    public function getType($type)
    {
        $array = self::getTypeOptions();
        return $array[$type];
    }
    
    
     /**
     * Return the label for type can be called like this typeLabel
     * @return array
     */
    public function getTypeLabel()
    {
        $array = self::getTypeOptions();
        return $array[$this->type];
    }
    
    /**
     * Set a trace message
     * @param type $message
     * @param type $type
     * @param type $object_id
     * @param type $content
     * @return boolean
     */
    public static function setTrace($message, $type, $object_id, $content=null){
        $trace = new Trace();
        $trace->user_id = (!isset(\Yii::$app->user) || \Yii::$app->user->isGuest) ? null : Yii::$app->user->id;
        $trace->type = $type;
        $trace->object_id = $object_id;
        $trace->message = $message;
        if($content !== null)
            $trace->content = $content;
        if($trace->save()){
            return true;
        }else{
            \Yii::info($trace->getErrors());
            return false;
        }
    }
}
