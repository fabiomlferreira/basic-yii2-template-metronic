<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return  \Yii::$app->user->can('manageApp');
                        }
                    ],
                    [
                        'actions' => ['logout', 'upload-files', 'alerta', 'counties'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    if (Yii::$app->user->isGuest)
                        $this->redirect(['/login']);
                    else
                        throw new ForbiddenHttpException(Yii::t('app', "You don't have permission to access this page."));
                }
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'layout' => 'error',
                'class' => 'yii\web\ErrorAction',
            ],
            /*'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],*/
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    /**
     * Users that are entities bue dont have any entity associated
     * @return type
     */
    public function actionAlerta(){
        return $this->render('alerta');
    }
    
    /**
     * Provides upload file
     * @return mixed
     */
    public function actionUploadFiles()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = new \fabiomlferreira\filemanager\models\Mediafile();
        $routes = \Yii::$app->modules['filemanager']['routes'];
        $rename = \Yii::$app->modules['filemanager']['rename'];
	 
        $model->saveUploadedFile($routes, $rename);
        $bundle = \fabiomlferreira\filemanager\assets\FilemanagerAsset::register($this->view);

        if ($model->isImage()) {
            if(\Yii::$app->modules['filemanager']['optimizeOriginalImage']){
                $quality = \Yii::$app->modules['filemanager']['originalQuality'];
                $maxSize = \Yii::$app->modules['filemanager']['maxSideSize'];
                $model->optimizeOriginal($routes, $quality, $maxSize);
            }
            $model->createThumbs($routes, \Yii::$app->modules['filemanager']['thumbs']);
        }
        $response['files'][] = [
            'url'           => $model->url,
            //'thumbnailUrl'  => $model->getDefaultThumbUrl($bundle->baseUrl),
            'thumbnailUrl'  => $model->isImage() ? $model->getThumbUrl('small_square') : \yii\helpers\Url::to("/img/file.png"),
            'name'          => $model->filename,
            'type'          => $model->type,
            'size'          => $model->file->size,
            'deleteUrl'     => \yii\helpers\Url::to(['file/delete', 'id' => $model->id]),
            'deleteType'    => 'POST',
            'media_id'      => $model->id
        ];
        /*$response=[
            'initialPreview'=> [
                $model->getThumbUrl('small_square'),
            ],
            'initialPreviewConfig' => [
                'caption'=> $model->filename,
                'showDelete'=> true,
                'size' => $model->file->size,
                'width'=> '120px', 
                'url'=> \yii\helpers\Url::to(['/filemanager/file/delete', 'id' => $model->id]), // server delete action 
                'key' => $model->id, 
                //extra: {id: 100}
            ],
        ];*/
        return $response;
    }
    
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
