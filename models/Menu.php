<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $position 1 - main menu | 2 - above top menu | 3 - footer menu
 * @property int $parent_id
 * @property string $title
 * @property string $lang
 * @property string $url
 * @property int $order
 * @property string $permission
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Menu $parent
 * @property Menu[] $menus
 */
class Menu extends \yii\db\ActiveRecord
{
    const POSITION_MAIN =           1;
    const POSITION_TOP =            2;
    const POSITION_BOTTOM =         3; 
    
    /*const PERMISSION_CHEFE_VENDAS = "chefeVendasApp";
    const PERMISSION_VENDEDORES = "vendedorApp";*/
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position', 'parent_id', 'order', 'created_at', 'updated_at'], 'integer'],
            [['title', 'url'], 'required'],
            [['title', 'url'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 10],
            [['permission'], 'string', 'max' => 64],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'position' => Yii::t('app', 'Position'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'title' => Yii::t('app', 'Title'),
            'lang' => Yii::t('app', 'Language'),
            'url' => Yii::t('app', 'Url'),
            'order' => Yii::t('app', 'Order'),
            'permission' => Yii::t('app', 'Permission'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    
    /**
     * After save create/update
     * @param type $insert
     * @param type $changedAttributes
     */
    public function afterSave($insert, $changedAttributes) { 
        \Yii::$app->cache->flush();
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['parent_id' => 'id'])->orderBy('order');
    }
    
    /**
     * Return an array with the items to create the menu in the selected language
     * @param type $position
     * @param type $options
     * @return string
     */
    public static function getItems($position = self::POSITION_MAIN, $options = [])
    {
        
        $defaultOptions = [
            'subMenuLinkOptions' => ['class' => 'dropdown-item'],
            'subMenuOptions' => [],
            'menuLinkOptions' => ['class' => 'nav-link'],
            'menuOptions' => ['class' => 'dropdown dropdown-primary'],
            'singleMenuLinkOptions' => ['class' => 'nav-link'],
            'singleMenuOptions' => []
        ];
        $options = array_merge($defaultOptions, $options);
        $item = [];
        $models = static::getDb()->cache(function ($db) use($position) {
            return static::find()->where(['parent_id' => NULL, 'lang' => \Yii::$app->language, 'position' =>$position])->orderBy('order')->all();
        });
        foreach($models as $model) {
            if(!empty($model->menus)){
                $subItems = [];
                foreach($model->menus as $submenu){
                   if(empty($submenu->permission) || \Yii::$app->user->can($submenu->permission)) 
                        $subItems[] = ['label' => $submenu->title, 'url' => [$submenu->url], 'linkOptions' => $options['subMenuLinkOptions'], 'options' =>$options['subMenuOptions']];
                }
                if(empty($model->permission) || \Yii::$app->user->can($model->permission)) 
                    $item[] = ['label' => $model->title, 'items' => $subItems, 'linkOptions' => $options['menuLinkOptions'], 'options' => $options['menuOptions'] ];

            }else{
                if(empty($model->permission) || \Yii::$app->user->can($model->permission)) 
                    $item[] = ['label' => $model->title, 'url' => [$model->url], 'active'=>Yii::$app->request->getUrl() == Url::toRoute([$model->url]), 'linkOptions' => $options['singleMenuLinkOptions'], 'options' =>$options['singleMenuOptions'] ];
            }
        }
        if($position == self::POSITION_MAIN && !\Yii::$app->user->isGuest){
            $item[] = ['label' => Yii::t('app', 'My account'), 'url' => ['/site/user-dashboard']];
        }
        if($position == self::POSITION_MAIN && \Yii::$app->user->isGuest){
             $item[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/login']];
        }
        if($position == self::POSITION_BOTTOM){
            $countryItem = [];
            $route = '/'.\Yii::$app->controller->route;
            $params = $_GET;
            array_unshift($params, $route); 
            $paramsPT = $params;
            $paramsPT['language'] = 'pt';
            $paramsFR = $params;
            $paramsFR['language'] = 'fr';
            $paramsDE = $params;
            $paramsDE['language'] = 'de';
            $paramsRU = $params;
            $paramsRU['language'] = 'ru';
            $paramsIT = $params;
            $paramsIT['language'] = 'it';
            $paramsEN = $params;
            $paramsEN['language'] = 'en';
            if(\Yii::$app->language == 'fr-FR'){
                $countryItem[] = ['label' => '<img src="/img/icons/de-DE_icon.png" alt="Language German" height="24">', 'url' => Url::to($paramsDE), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/en-US_icon.png" alt="Language English" height="24">', 'url' => Url::to($paramsEN), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/it-IT_icon.png" alt="Language Italian" height="24">', 'url' => Url::to($paramsIT), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/ru-RU_icon.png" alt="Language Russian" height="24">', 'url' => Url::to($paramsRU), 'encode' => false];
                //$item[] = ['label' => '<img src="/img/icons/pt-PT_icon.png" alt="Language Portuguese" height="24">', 'url' => "#", 'encode' => false, 'linkOptions'=> ['class' => 'remove-caret', 'aria-expanded'=>"false", 'aria-haspopup'=>'true'], 'items' => $countryItem];
                $item[] = ['label' => '<img src="/img/icons/fr-FR_icon.png" alt="Language French" height="24">', 'url' => "#", 'encode' => false, 'linkOptions'=> ['class' => 'remove-caret', 'aria-expanded'=>"false", 'aria-haspopup'=>'true'], 'items' => $countryItem];
            }elseif(\Yii::$app->language == 'de-DE'){
                $countryItem[] = ['label' => '<img src="/img/icons/en-US_icon.png" alt="Language English" height="24">', 'url' => Url::to($paramsEN), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/fr-FR_icon.png" alt="Language French" height="24">', 'url' => Url::to($paramsFR), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/it-IT_icon.png" alt="Language Italian" height="24">', 'url' => Url::to($paramsIT), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/ru-RU_icon.png" alt="Language Russian" height="24">', 'url' => Url::to($paramsRU), 'encode' => false];
                //$item[] = ['label' => '<img src="/img/icons/pt-PT_icon.png" alt="Language Portuguese" height="24">', 'url' => "#", 'encode' => false, 'linkOptions'=> ['class' => 'remove-caret', 'aria-expanded'=>"false", 'aria-haspopup'=>'true'], 'items' => $countryItem];
                $item[] = ['label' => '<img src="/img/icons/de-DE_icon.png" alt="Language German" height="24">', 'url' => "#", 'encode' => false, 'linkOptions'=> ['class' => 'remove-caret', 'aria-expanded'=>"false", 'aria-haspopup'=>'true'], 'items' => $countryItem];
            }elseif(\Yii::$app->language == 'ru-RU'){
                $countryItem[] = ['label' => '<img src="/img/icons/de-DE_icon.png" alt="Language German" height="24">', 'url' => Url::to($paramsDE), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/en-US_icon.png" alt="Language English" height="24">', 'url' => Url::to($paramsEN), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/fr-FR_icon.png" alt="Language French" height="24">', 'url' => Url::to($paramsFR), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/it-IT_icon.png" alt="Language Italian" height="24">', 'url' => Url::to($paramsIT), 'encode' => false];
                //$item[] = ['label' => '<img src="/img/icons/pt-PT_icon.png" alt="Language Portuguese" height="24">', 'url' => "#", 'encode' => false, 'linkOptions'=> ['class' => 'remove-caret', 'aria-expanded'=>"false", 'aria-haspopup'=>'true'], 'items' => $countryItem];
                $item[] = ['label' => '<img src="/img/icons/ru-RU_icon.png" alt="Language Russian" height="24">', 'url' => "#", 'encode' => false, 'linkOptions'=> ['class' => 'remove-caret', 'aria-expanded'=>"false", 'aria-haspopup'=>'true'], 'items' => $countryItem];
            }elseif(\Yii::$app->language == 'it-IT'){
                $countryItem[] = ['label' => '<img src="/img/icons/de-DE_icon.png" alt="Language German" height="24">', 'url' => Url::to($paramsDE), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/en-US_icon.png" alt="Language English" height="24">', 'url' => Url::to($paramsEN), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/fr-FR_icon.png" alt="Language French" height="24">', 'url' => Url::to($paramsFR), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/ru-RU_icon.png" alt="Language Russian" height="24">', 'url' => Url::to($paramsRU), 'encode' => false];
                //$item[] = ['label' => '<img src="/img/icons/pt-PT_icon.png" alt="Language Portuguese" height="24">', 'url' => "#", 'encode' => false, 'linkOptions'=> ['class' => 'remove-caret', 'aria-expanded'=>"false", 'aria-haspopup'=>'true'], 'items' => $countryItem];
                $item[] = ['label' => '<img src="/img/icons/it-IT_icon.png" alt="Language Italian" height="24">', 'url' => "#", 'encode' => false, 'linkOptions'=> ['class' => 'remove-caret', 'aria-expanded'=>"false", 'aria-haspopup'=>'true'], 'items' => $countryItem];
            }else{
                $countryItem[] = ['label' => '<img src="/img/icons/de-DE_icon.png" alt="Language German" height="24">', 'url' => Url::to($paramsDE), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/fr-FR_icon.png" alt="Language French" height="24">', 'url' => Url::to($paramsFR), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/it-IT_icon.png" alt="Language Italian" height="24">', 'url' => Url::to($paramsIT), 'encode' => false];
                $countryItem[] = ['label' => '<img src="/img/icons/ru-RU_icon.png" alt="Language Russian" height="24">', 'url' => Url::to($paramsRU), 'encode' => false];
                //$countryItem[] = ['label' => '<img src="/img/icons/pt-PT_icon.png" alt="Language Portuguese" height="24">', 'url' => Url::to($paramsPT), 'encode' => false];
                //$countryItem[] = ['label' => '<img src="/img/icons/fr-FR_icon.png" alt="Language French" height="24">', 'url' => Url::to($paramsFR), 'encode' => false];
                $item[] = ['label' => '<img src="/img/icons/en-US_icon.png" alt="Language English" height="24">', 'url' => "#", 'encode' => false, 'linkOptions'=> ['class' => 'remove-caret', 'aria-expanded'=>"false", 'aria-haspopup'=>'true'], 'items' => $countryItem];
            }
            /*$item[]= '<li class="dropdown nav-item">'
                    . '<a class="remove-caret dropdown-toggle nav-link" href="#" aria-expanded="false" aria-haspopup="true" data-toggle="dropdown">'
                    . '<img src="/img/icons/EN_Icon.png" alt="Language English" height="24">'
                    . '</a>'
                    . '<div id="language_dropdown" class="dropdown-menu">'
                    . '<a class="dropdown-item" href="#"><img src="/img/icons/PT_Icon.png" alt="Language Portuguese" height="24"></a>'
                    . '</div>'
                    . '</li>';*/
        }
        /*if($position == self::POSITION_MAIN && !\Yii::$app->user->isGuest){
             $item[] = ['label' => Yii::t('app', 'Logout'), 'url' => ['/logout'], 'linkOptions' => ['data-method' => 'post']];
        }
        if($position == self::POSITION_MAIN && \Yii::$app->user->isGuest){
             $item[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/login']];
        }*/
        
        return $item;
    }
    
    /**
     * Devolve o texto relativo à position selecionado
     * @return array
     */
    public function getPosition($position)
    {
        $array = self::getPositionOptions();
        return $array[$position];
    }
    
     /**
     * Desolve o label da position para usar em gridviews e assim basta meter no attribute positionLabel
     * @return array
     */
    public function getPositionLabel()
    {
        $array = self::getPositionOptions();
        return $array[$this->position];
    }
    
    /**
     * Devolve um array com os valores que o campo comment position pode ter
     * @return array
     */
    public function getPositionOptions()
    {
        return [
            self::POSITION_MAIN =>  Yii::t('app', 'Main Menu'), 
            self::POSITION_TOP =>  Yii::t('app', 'Top'),
            self::POSITION_BOTTOM =>  Yii::t('app', 'Footer')
        ];
    }
    
    /**
     * Return the menu parent in the required language or false if not exist
     * @return \yii\db\ActiveQuery
     */
    /*ßpublic function getTranslation($language)
    {
        //if we ask for the language of the own model return this model
        if($language == $this->lang)
            return $this;
        $model = $this->find()->orWhere(['lang' => $language, 'parent_id' => $this->id])->orWhere(['lang' => $language, 'id' => $this->parent_id])->one();
        if($model === NULL)
            return false; 
        else
            return $model;
    }*/
    
    /**
     * Devolve o texto relativo à permission selecionado
     * @return array
     */
    /*public function getPermission($permission)
    {
        $array = self::getPermissionOptions();
        return $array[$permission];
    }*/
    
     /**
     * Desolve o label da permission para usar em gridviews e assim basta meter no attribute permissionLabel
     * @return array
     */
    /*public function getPermissionLabel()
    {
        $array = self::getPermissionOptions();
        return $array[$this->permission];
    }*/
    
    /**
     * Devolve um array com os valores que o campo permission pode ter
     * @return array
     */
    /*public function getPermissionOptions()
    {
        return [
            self::PERMISSION_VENDEDORES =>  'Vendedores', 
            self::PERMISSION_CHEFE_VENDAS =>  'Chefes de Vendas',
        ];
    }*/
}
