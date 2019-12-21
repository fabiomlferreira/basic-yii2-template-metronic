<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'name' => "Gestão",
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
            // ...other configs from here: [Configuration Options](installation/configuration-options.md), e.g.
            'generatePasswords' => false, 
            // 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
            //'enableGDPRcompliance' => true,
            'allowAccountDelete' => false,
            'enableFlashMessages' => true,
            'enableRegistration' => true,
            //'administrators' => ['fabiomlferreira'],
            'administratorPermissionName'=>'manageUsers',
            'classMap' => [
                'User' => app\models\user\User::class,
                'Profile' => app\models\user\Profile::class,
            ],
            'mailParams'=>[
                'fromEmail' => 'no-reply@noop.pt',
            ],
            'controllerMap' => [
                'security' => [
                    'class' => 'Da\User\Controller\SecurityController',
                    'layout' => "/login",
                ],
                'admin' => 'app\controllers\user\AdminController',
                //'security' => 'Da\User\Controller\SecurityController',
                //'registration' => [
                //    'class' => 'dektrium\user\controllers\RegistrationController',
                //    'layout' => "main",
                //],
                'registration' => [
                  'class' => 'Da\User\Controller\RegistrationController',
                  'layout' => "/login",
                 ],
                'recovery' => [
                    'class' => 'Da\User\Controller\RecoveryController',
                    'layout' => "/login",
                ],
            //'admin' => 'app\controllers\user\AdminController',
            //'profile' => 'app\controllers\user\ProfileController'
            ],
        ],
        'gridview' => [
            'class' => 'kartik\grid\Module',
            // other module settings
        ],
        'filemanager' => [
            'class' => 'fabiomlferreira\filemanager\Module',
            'rename' => true, //permite ter fazer upload de fotos com o mesmo nome
            'autoUpload' => true,
            'optimizeOriginalImage' => true,
            'maxSideSize' => 1200,
            'originalQuality' => 90,
            'thumbnailOnTheFly' => false,  //if is true the component thumbnail should be used
            // Upload routes
            'routes' => [
                // Base absolute path to web directory
                'baseUrl' => '',
                // Base web directory url
                'basePath' => '@app/web',
                // Path for uploaded files in web directory
                'uploadPath' => 'uploads',
            ],
            // Thumbnails info
            'thumbs' => [ 
                'default' => [
                    'name' => 'default',
                    'size' => [125, 125],
                    //'mode' => \Imagine\Image\ImageInterface::THUMBNAIL_INSET
                ],
                'default_inset' => [
                    'name' => 'default_inset',
                    'size' => [125, 125],
                    'mode' => \Imagine\Image\ImageInterface::THUMBNAIL_INSET
                ],
                'small_square' => [
                    'name' => 'small_square',
                    'size' => [400, 400],
                ],
                'small_square_inset' => [
                    'name' => 'small_square_inset',
                    'mode' => \Imagine\Image\ImageInterface::THUMBNAIL_INSET,
                    'size' => [400, 400],
                ],
                'blog_list' => [
                    'name' => 'blog_list',
                    'size' => [540, 360],
                ],
            ],
            //restringe o acesso a este modulo
            'as access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        //'actions' => ['filemanager'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                           // if(Yii::$app->request->isConsoleRequest)
                                //return true;
                            return \Yii::$app->user->can('adminApp');
                        }
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    if (Yii::$app->user->isGuest)
                         Yii::$app->controller->redirect(['/login']);
                    else
                        throw new \yii\web\ForbiddenHttpException(Yii::t('app', "You don't have permission to access this page."));
                }
            ],
        ],
        'translatemanager' => [
            'class' => 'lajax\translatemanager\Module',
            'roles' => ['adminApp'],               // For setting access levels to the translating interface.
            'scanTimeLimit' => 600,
           /* 'root' => '@app',               // The root directory of the project scan.
            'scanRootParentDirectory' => true, // Whether scan the defined `root` parent directory, or the folder itself.
                                               // IMPORTANT: for detailed instructions read the chapter about root configuration.
            'layout' => 'language',         // Name of the used layout. If using own layout use 'null'.
            */
            'allowedIPs' => ['*'],  // IP addresses from which the translation interface is accessible.
            /*'roles' => ['@'],               // For setting access levels to the translating interface.
            'tmpDir' => '@runtime',         // Writable directory for the client-side temporary language files.
                                            // IMPORTANT: must be identical for all applications (the AssetsManager serves the JavaScript files containing language elements from this directory).
            'phpTranslators' => ['::t'],    // list of the php function for translating messages.
            'jsTranslators' => ['lajax.t'], // list of the js function for translating messages.
            'patterns' => ['*.js', '*.php'],// list of file extensions that contain language elements.*/
            'ignoredCategories' => ['yii', 'language', 'model', 'fileupload', 'usuario', 'main', 'kvselect', 'kvbase', 'kvdtime', 'kvdate', 'array', 'javascript'], // these categories won't be included in the language database.
            /*'ignoredItems' => ['config'],   // these files will not be processed.
            'scanTimeLimit' => null,        // increase to prevent "Maximum execution time" errors, if null the default max_execution_time will be used
            'searchEmptyCommand' => '!',    // the search string to enter in the 'Translation' search field to find not yet translated items, set to null to disable this feature
            'defaultExportStatus' => 1,     // the default selection of languages to export, set to 0 to select all languages by default
            'defaultExportFormat' => 'json',// the default format for export, can be 'json' or 'xml'
            'tables' => [                   // Properties of individual tables
                [
                    'connection' => 'db',   // connection identifier
                    'table' => '{{%language}}',         // table name
                    'columns' => ['name', 'name_ascii'],// names of multilingual fields
                    'category' => 'database-table-name',// the category is the database table name
                ]
            ]*/
        ],
    ],
    'container' => [
        'definitions' => [
            yii\grid\GridView::class => [
                'class' => 'luya\bootstrap4\grid\GridView',
                'options' => [
                    'class' => 'table table-striped table-bordered kt-table table-responsive',
                ],
            ],
            yii\grid\ActionColumn::class => [
                'class' => 'luya\bootstrap4\grid\ActionColumn',
                'header' => Yii::t('app', 'Options'),
                'headerOptions' => ['style' => 'width: 127px;'],
                //'buttonOptions' => ['class' => 'btn kt-btn kt-btn--hover-accent kt-btn--icon kt-btn--icon-only kt-btn--pill'], // antigo
                'buttonOptions' => ['class' => 'btn btn-sm btn-clean btn-icon btn-icon-md'],
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return yii\helpers\Html::a('<i class="fa fa-trash" aria-hidden=""></i>', $url, [
                            'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            //'class' => 'kt-portlet__nav-link btn kt-btn kt-btn--hover-danger kt-btn--icon kt-btn--icon-only kt-btn--pill' // antigo
                            'class' => 'btn btn-sm btn-clean btn-icon btn-icon-md'
                        ]);
                    }
                ],
            ],
            yii\widgets\DetailView::class => [
                'options' => [
                    'class' => 'table table-striped table-bordered kt-table',
                ],
            ],
           // kartik\base\AssetBundle::
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '0J5NWguBl7GJf6y9uVg1127_2iX_9Sdr',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@app/runtime/cache', //caminho comum para guardar a cache para conseguir apagar atravez do backend
        ],
        /*'user' => [
            'identityClass' => 'app\models\user\User',
            'enableAutoLogin' => true,
        ],*/
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'debugmail.io',
                'username' => 'eu@fabioferreira.pt',
                'password' => 'cda69570-2286-11ea-ae24-b36df4ace27b',
                'port' => '25',
                'encryption' => 'tls',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'registar' => 'user/registration/register',
                'reenviar' => 'user/registration/resend',
                'confirmar/<id:\d+>/<token:\w+>' => 'user/registration/confirm',
                'login' => '/user/security/login', //nao funciona
                'logout' => '/user/security/logout', //nao funciona
                'recuperar' => 'user/recovery/request',
                'reset/<id:\d+>/<token:\w+>' => 'user/recovery/reset',
                'perfil' => 'user/settings/profile',
                'minha-conta' => 'user/settings/account',
                'admin-utilizadores' => 'user/admin/index',
                //'user/<id:\d+>'  => 'user/profile/show', //tive que meter isto senão não conseguia aceder ao perfil do utilizador via link/user/1
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@Da/User/resources/views' => '@app/views/user',
                    '@vendor/fabiomlferreira/yii2-file-manager/views' => '@app/views/filemanager'
                ]
            ]
        ],

        'authManager' => [
            'class' => 'Da\User\Component\AuthDbManagerComponent',
            //'defaultRoles' => ['guest', 'user', 'admin'],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => [],
                    'css' => [],
                    'depends' => ['app\assets\AppAsset'],
                    //'jsOptions' => ['position' => \yii\web\View::POS_HEAD] // activate to put jquery on head
                ],/*
                'frontend\assets\ModernizrAsset'=> [
                    'js' => [
                        'js/modernizr/modernizr.min.js'
                        //YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                    ],
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD] // activate to put jquery on head
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        'js/bootstrap.min.js'
                    ]
                ],*/
                
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [],
                    'depends' => ['app\assets\AppAsset']
                ],
                'yii\web\YiiAsset' => [
                    'depends' => ['app\assets\AppAsset'],
                ], 
                'yii\bootstrap4\BootstrapPluginAsset' => [ // disable boostrap assets
                    'sourcePath' => null,
                    'css' => [],
                    'js' => [],
                    'depends' => []
                ],
                'yii\bootstrap4\PopperAsset' => [
                            'sourcePath' => null,
                            'js' => [],
                            
                ],
                'yii\bootstrap4\BootstrapAsset'=> [
                    'sourcePath' => null,
                    'js' => [],
                    'css' => [],
                ],
                'fabiomlferreira\filemanager\assets\ModalAsset'=>[
                    'depends' => ['app\assets\AppAsset'],
                ],
                'fabiomlferreira\filemanager\assets\FilemanagerAsset'=>[
                    'depends' => ['app\assets\AppAsset'],
                ],
                'fabiomlferreira\filemanager\assets\FileInputAsset'=>[
                    'depends' => ['fabiomlferreira\filemanager\assets\ModalAsset'],
                ],
                /*'kartik\base\AssetBundle'=>[
                    'depends' => [],
                ] */
                'kartik\select2\ThemeDefaultAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    //'css' => ['css/select2-bootstrap4.min.css'],
                    'css' => [],
                ],
                'kartik\select2\Select2Asset' => [
                    //'sourcePath' => null,
                    //'basePath' => '@webroot',
                    //'baseUrl' => '@web',
                    //'css' => ['css/select2-bootstrap4.min.css'],
                    'css' => [],
                ],
                'lajax\translatemanager\bundles\TranslateManagerAsset' => [
                    'css' => [],
                ]
            ],
        ],
        'grid'=>[
            'class' => 'luya\bootstrap4\grid',
            //'tableOptions'=>['class'=>'table table-condensed'],
        ],
        'thumbnail' => [
            'class' => 'fabiomlferreira\filemanager\Thumbnail',
            'cachePath' => '@webroot/assets/thumbnails',
            'basePath' => '@webroot',
            'cacheExpire' => 2592000,
            'options' => [
                'placeholder' => [
                    'type' => fabiomlferreira\filemanager\Thumbnail::PLACEHOLDER_TYPE_JS,
                    'backgroundColor' => '#f5f5f5',
                    'textColor' => '#cdcdcd',
                    'text' => 'Ooops',
                    'random' => true,
                    'cache' => false,
                ],
                'quality' => 75
            ]
        ],
        'config' => [
            'class' => 'app\components\Config'
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'db' => 'db',
                    'sourceLanguage' => 'en-US', // Developer language
                    'sourceMessageTable' => '{{%language_source}}',
                    'messageTable' => '{{%language_translate}}',
                    'cachingDuration' => 86400,
                    'enableCaching' => false,
                    'forceTranslation' => true,
                ],
                'app' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'db' => 'db',
                    'sourceLanguage' => 'en-US', // Developer language
                    'sourceMessageTable' => '{{%language_source}}',
                    'messageTable' => '{{%language_translate}}',
                    'forceTranslation' => true,
                    'cachingDuration' => 86400,
                    'enableCaching' => false,
                ],
                'usuario' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'usuario' => 'usuario.php',
                    ],
                ],
            ],
        ],
    ],
    
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '188.80.227.229', '2001:8a0:f36e:f01:a967:5cf2:f34:fd9c']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '188.80.227.229', '2001:8a0:f36e:f01:a967:5cf2:f34:fd9c'],
         'generators' => [ //here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'MeuCrud' => '@app/giiTemplates/crud/default', // template name => path to template
                ]
            ],
            'model' => [ // generator name
                'class' => 'yii\gii\generators\model\Generator', // generator class
                'templates' => [ //setting for out templates
                    'MeuModel' => '@app/giiTemplates/model/default', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
