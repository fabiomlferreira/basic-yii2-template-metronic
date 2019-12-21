<?php
namespace app\helpers;

use fabiomlferreira\filemanager\models\Mediafile;

class UploadHelper
{
    public static function saveUploadedFile($files){
        //$model = Mediafile();
        $routes = \Yii::$app->modules['filemanager']['routes'];
        $rename = \Yii::$app->modules['filemanager']['rename'];
        $optimizeOriginalImage = \Yii::$app->modules['filemanager']['optimizeOriginalImage'];
        if($optimizeOriginalImage){
            $quality=\Yii::$app->modules['filemanager']['originalQuality'];
            $maxSize = \Yii::$app->modules['filemanager']['maxSideSize'];
        }
        $thumbs = \Yii::$app->modules['filemanager']['thumbs'];
        
	$filesIds = [];
        foreach($files as $file){
            $model = new Mediafile();
            if($model->saveCurrentFile($file, $routes, $rename)){

                if ($model->isImage()) {
                    if($optimizeOriginalImage){
                        //$quality = \Yii::$app->modules['filemanager']['originalQuality'];
                        //$maxSize = \Yii::$app->modules['filemanager']['maxSideSize'];
                        $model->optimizeOriginal($routes, $quality, $maxSize);
                    }
                    $model->createThumbs($routes, $thumbs);
                }
                /*$response['files'][] = [
                    'url'           => $model->url,
                    //'thumbnailUrl'  => $model->getDefaultThumbUrl($bundle->baseUrl),
                    'thumbnailUrl'  => $model->getThumbUrl('small_square'),
                    'name'          => $model->filename,
                    'type'          => $model->type,
                    'size'          => $model->file->size,
                    'deleteUrl'     => \yii\helpers\Url::to(['file/delete', 'id' => $model->id]),
                    'deleteType'    => 'POST',
                    'media_id'      => $model->id
                ];*/
                $filesIds[]=$model->id;
            }
        }
       
        return $filesIds;
    }
    
    
}
?>