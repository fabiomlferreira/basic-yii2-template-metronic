<?php

namespace app\models\user;

use Yii;
use yii\base\Model;

/**
 * PermissionForm is the model behind the user permissions.
 *
 * @property User|null $user This property is read-only.
 *
 */
class PermissionForm extends Model
{
    const SCENARIO_REGISTRATION = 'registration';
    /*Roles*/
    public $superAdmin = false;
    public $admin = false;
    public $manager = false;
    public $user = false;
    
    
    /*Permissions*/
    public $manageApp = false;
    public $manageUsers = false;
    public $accessUser = false;
    
    public $user_id;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['user_id'], 'required', 'on' => [self::SCENARIO_DEFAULT]],
            [['user_id'], 'integer'],
            [['superAdmin', 'admin', 'manager','user', 'manageApp', 'manageUsers', 'accessUser'], 'boolean'],
            /*[['superAdmin', 'admin', 'gestor', 'deputado'], 'required', 'when' => function($model) {
                    return ($model->payment_method == self::PAYMENT_METHOD_MBWAY);
                }, 'whenClient' => "function (attribute, value) {
                    return ($('#service-payment_method').val() == '4');
                }"
            ],*/
            [['superAdmin', 'admin', 'manager', 'user'], 'validateRoles' , 'skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }
    
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'superAdmin' => Yii::t('backend', 'Super Administrator'),
            'admin' => Yii::t('backend', 'Administrator'),
            'manager' => Yii::t('backend', 'Manager'),
            'user' => Yii::t('backend', 'User'),
            'manageApp' => Yii::t('backend', 'Manage App'),
            'manageUsers' => Yii::t('backend', 'Manage Users'),
            'accessUser' => Yii::t('backend', 'Access User'),
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
       // $scenarios[self::SCENARIO_REGISTRATION] =  array_diff($scenarios[self::SCENARIO_DEFAULT], ['user_id'] );
        $scenarios[self::SCENARIO_REGISTRATION] =  $scenarios[self::SCENARIO_DEFAULT];
        return $scenarios;
    }   

    /**
     * Function to valitate if at least one is selected
     * @param type $attribute
     * @param type $params
     * @param type $validator
     */
    public function validateRoles($attribute, $params, $validator)
    {
        if($this->user == false && $this->manager == false && $this->admin == false && $this->superAdmin == false){
            $this->addError($attribute,  Yii::t('backend', 'The users must have one of the roles associated'));
        }
    }
    
    /**
     * Load the permissions and roles
     * @return type
     */
    public function loadUserPermissions(){
        $auth = \Yii::$app->authManager;
        $permissions = $auth->getPermissionsByUser($this->user_id);
        /*$assignments = $auth->getAssignments($this->user_id);
        foreach($assignments as $key => $permission){
            if($this->hasProperty($key)){
                $this->$key = true;
            }
        }*/
        $roles = $auth->getRolesByUser($this->user_id);
        foreach($roles as $key => $permission){
            if($this->hasProperty($key)){
                $this->$key = true;
            }
        }
        foreach($permissions as $key => $permission){
            if($this->hasProperty($key)){
                $this->$key = true;
            }
        }
        return true;
        //return $assignments;
    }
    
    public function getPermissionsPerRole(){
        $auth = \Yii::$app->authManager;
        $roles = $auth->getRoles();
        $rolesArray = [];
        foreach($roles as $key => $role){
            $permissions = $auth->getPermissionsByRole($key);
            foreach($permissions as $index => $permission){
               $rolesArray[$key][] = $index;
            }
        }
        return $rolesArray;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function setPermissions(){
        if($this->validate()){
            $auth = \Yii::$app->authManager;
            $auth->revokeAll($this->user_id);
            //Roles
            if($this->superAdmin)
                $auth->assign($auth->getRole('superAdmin'), $this->user_id);
            if($this->admin)
                $auth->assign($auth->getRole('admin'), $this->user_id);
            if($this->manager)
                $auth->assign($auth->getRole('manager'), $this->user_id);
            if($this->user)
                $auth->assign($auth->getRole('user'), $this->user_id);
           
           
            //Permissions
            if($this->manageApp)
                $auth->assign($auth->getPermission('manageApp'), $this->user_id);
            if($this->manageUsers)
                $auth->assign($auth->getPermission('manageUsers'), $this->user_id);
            if($this->accessUser)
                $auth->assign($auth->getPermission('accessUser'), $this->user_id);
           
            return true;
        }else
            return false;
    }
    
}
