<?php
namespace app\models\user;
use Yii;
use fabiomlferreira\filemanager\models\Mediafile;
use fabiomlferreira\filemanager\behaviors\MediafileBehavior;

use Da\User\Model\Profile as BaseProfile;

/**
 * This is a override to the Profile model
 * @property int $user_id
 * @property string $name
 * @property int $image_id
 * @property string $public_email
 * @property string $gravatar_email
 * @property string $gravatar_id
 * @property string $location
 * @property string $website
 * @property string $bio
 * @property string $timezone
 * @property User $user
 * 
 * @property Mediafile $image
 * @author Fábio Ferreira
 */
class Profile extends BaseProfile
{
    /** @inheritdoc */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['image_id'], 'integer'];
        $rules[] = [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mediafile::className(), 'targetAttribute' => ['image_id' => 'id']];

        return $rules;
    }
    
   /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $attributes = parent::attributeLabels();
        $attributes['image_id'] = "Imagem";
        
        return $attributes;
    }
    
    /**
    * Added behaviour to assign the image to the user
    * @return type
    */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['mediafile']=[
            'class' => MediafileBehavior::className(),
            'name' => 'profile',
            'attributes' => [
                'image_id',
            ],
        ];
        return $behaviors;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Mediafile::className(), ['id' => 'image_id']);
    }
    
    /**
     * Return the url ot the image os the user profile
     * @return type
     */
    public function getUserImage(){
        if(is_object($this->image)){
            return $this->image->getThumbUrl('small_square');
        }else{
            return \yii\helpers\Url::to("/img/default_user.jpg");
        }
    }
   
}