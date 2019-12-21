<?php
namespace app\controllers\user;

use Da\User\Controller\AdminController as BaseController;
use yii\helpers\Url;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\user\Profile;
use app\models\user\User;
use app\models\user\PermissionForm;
use Da\User\Event\UserEvent;
use Da\User\Validator\AjaxRequestModelValidator;
use Da\User\Factory\MailFactory;
use Da\User\Service\UserCreateService;


class AdminController extends BaseController {

    /**
     * @param \yii\base\Action $action
     *
     * @return bool
     */
    public function beforeAction($action)
    {
        if (in_array($action->id, ['permissions'], true)) {
            Url::remember('', 'actions-redirect');
        }

        return parent::beforeAction($action);
    }
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $array = parent::behaviors();
        return $array;
        //$array['access']
    }
    
    /**
     * Page to set permissions to a specific user
     * @param type $id
     * @return type
     */
    public function actionPermissions($id)
    {
        /** @var User $user */
        $user = $this->userQuery->where(['id' => $id])->one();
        $model = new PermissionForm();
        $model->user_id = $user->id;
        $model->loadUserPermissions();

        if ($model->load(Yii::$app->request->post()) && $model->setPermissions()) {
        }

        return $this->render(
            '_permissions',
            [
                'user' => $user,
                'model' => $model,
            ]
        );
    }
    
    public function actionCreate()
    {
        /** @var User $user */
        $user = $this->make(User::class, [], ['scenario' => 'create']);
        $profile = new Profile();
        $permissions = new PermissionForm();
        $permissions->scenario = PermissionForm::SCENARIO_REGISTRATION;
        //$permissions->atleta = true;

        /** @var UserEvent $event */
        $event = $this->make(UserEvent::class, [$user]);

        $this->make(AjaxRequestModelValidator::class, [$user])->validate();

        if ($user->load(Yii::$app->request->post()) && $profile->load(Yii::$app->request->post()) && $permissions->load(Yii::$app->request->post()) && $user->validate() && $profile->validate() && $permissions->validate()) {
            $this->trigger(UserEvent::EVENT_BEFORE_CREATE, $event);

            /* Para não enviar emails para as pessoas quando criamos emails*/
            //$prev_email = $user->email;
            //$user->email = "geral@noop.pt";
            $mailService = MailFactory::makeWelcomeMailerService($user);
            //$user->email = $prev_email;

            if ($this->make(UserCreateService::class, [$user, $mailService])->run()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('usuario', 'User has been created'));
                $this->trigger(UserEvent::EVENT_AFTER_CREATE, $event);
                $user->refresh(); // reload data
                if(is_object($user->profile)){
                    $newProfile = $user->profile;
                    $newProfile->name = $profile->name;
                    $newProfile->image_id = $profile->image_id;
                    //$newProfile->entity_id = $profile->entity_id;
                    if(!$newProfile->save()){
                        Yii::$app->session->setFlash('warning', Yii::t('app', 'Some data of user profile was not saved.'));
                    }
                    /*Permissions*/
                    $permissions->user_id = $user->id;
                    if(!$permissions->setPermissions()) {
                        Yii::$app->session->setFlash('warning', Yii::t('app', 'We were unable to add the permissions to the user.'));
                    }                    
                    return $this->redirect(['update', 'id' => $user->id]);
                }else{
                    Yii::$app->session->setFlash('warning', Yii::t('app', 'Some data of user profile was not saved.'));
                    return $this->redirect(['update', 'id' => $user->id]);
                }
            }
            Yii::$app->session->setFlash('danger', Yii::t('usuario', 'User account could not be created.'));
        }

        return $this->render('create', ['user' => $user, 'profile' => $profile, 'permissions' => $permissions]);
    }
}