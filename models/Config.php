<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "config".
 *
 * @property int $id
 * @property int $type 1 - textfield | 2 - textarea | 3 - checkbox | 4 - select | 5 - integer | 6 - decimal | 7 - currency | 8 - percentage | 9 - color | 10 - range
 * @property string $group
 * @property string $name
 * @property string $slug
 * @property string $options
 * @property string $value
 * @property int $created_at
 * @property int $updated_at
 */
class Config extends \yii\db\ActiveRecord
{
    const TYPE_TEXTFIELD = 1;
    const TYPE_TEXTAREA = 2;
    const TYPE_CHECKBOX = 3;
    const TYPE_SELECT = 4;
    const TYPE_INTEGER = 5;
    const TYPE_DECIMAL = 6;
    const TYPE_CURRENCY = 7;
    const TYPE_PERCENTAGE = 8;
    const TYPE_COLOR = 9;
    const TYPE_RANGE = 10;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['name', 'slug'], 'required'],
            [['options', 'value'], 'string'],
            [['group', 'name', 'slug'], 'string', 'max' => 255],
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
            'type' => Yii::t('app', 'Type'),
            'group' => Yii::t('app', 'Group'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'options' => Yii::t('app', 'Options'),
            'value' => Yii::t('app', 'Value'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    
    /**
     * After save create/update or remove attribute we clean the cache
     * @param type $insert
     * @param type $changedAttributes
     */
    public function afterSave($insert, $changedAttributes) { 
        \Yii::$app->cache->flush();
        parent::afterSave($insert, $changedAttributes);
    }
    
    /**
     * Return an array with the values of type field
     * @return array
     */
    public function getTypeOptions()
    {
        return [
            self::TYPE_TEXTFIELD =>  Yii::t('backend', 'Textfield'), 
            self::TYPE_TEXTAREA =>  Yii::t('backend', 'Textarea'), 
            self::TYPE_CHECKBOX =>  Yii::t('backend', 'Checkbox'), 
            self::TYPE_SELECT =>  Yii::t('backend', 'Select'), 
            self::TYPE_INTEGER =>  Yii::t('backend', 'Integer'), 
            self::TYPE_DECIMAL =>  Yii::t('backend', 'Decimal'), 
            self::TYPE_CURRENCY =>  Yii::t('backend', 'Currency'), 
            self::TYPE_PERCENTAGE =>  Yii::t('backend', 'Percentage'), 
            self::TYPE_COLOR =>  Yii::t('backend', 'Color'), 
            self::TYPE_RANGE =>  Yii::t('backend', 'Range'),
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
     * 
     * @param yii\bootstrap4\ActiveForm $form
     */
    public function getInputField($form, $as_array=false){
        $input = null;
        $attributeName = "value";
        if($as_array)
            $attributeName = "[$this->id]value";
        switch ($this->type){
            case self::TYPE_TEXTFIELD: // 1
                $input = $form->field($this, $attributeName)->textInput(['maxlength' => true]);
                break;
            case self::TYPE_TEXTAREA: // 2
                $input = $form->field($this, $attributeName)->textarea(['rows' => 6]);
                break;
            case self::TYPE_INTEGER: // 5
                $input = $form->field($this, $attributeName)->textInput(['type' => 'number', 'step' => 1]);
                break;
            case self::TYPE_CURRENCY: // 7
                $input = $form->field($this, $attributeName)->textInput(['type' => 'number', 'step' => 0.01]);
                /*<div class="input-group-append">
																	<span class="input-group-text">
																		€
																	</span>
																</div>*/
                break;
            case self::TYPE_PERCENTAGE: // 7
                $input = $form->field($this, $attributeName)->textInput(['type' => 'number', 'step' => 0.1, 'min' =>0, 'max' => 100]);
                break;
            default:
                $input =$form->field($this, $attributeName)->textarea(['rows' => 6]);
                break;
        }
        return $input;
    }
    
    /**
     * Return an object with the attribute and the value of all configs
     */
    public static function getConfigs()
    {
        $model = static::getDb()->cache(function ($db) {
            return static::find()->select(['slug','value' ])->all();
        });
        return $model;

    }
    
    /**
     * Return an object with the attribute and the value of all configs
     */
    public static function getOptions()
    {
        $model = static::getDb()->cache(function ($db) {
            return static::find()->select(['slug','options'])->all();
        });
        return $model;

    }
}
