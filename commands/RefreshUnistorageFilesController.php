<?php
namespace yii\unistorage\commands;

use Yii;
use yii\console\Controller;
use console\Console;
use yii\unistorage\Models\UnistorageCache;

/**
 * Class RefreshUnistorageFilesController
 * @package yii\unistorage\commands
 */
class RefreshUnistorageFilesController extends Controller
{
    public function actionIndex($refreshHours = 1)
    {
        $limit = 500;
        $offset = 0;

        $unistorageClient = Yii::$app->unistorage;
        $unistorageClient->useGetFileCache = false;
        $processedFiles = array();

        while (
            $rows = UnistorageCache::find()
            ->limit($limit)
            ->offset($offset)
            ->where('ttl<:time',[':time'=>time() + 3600 * $refreshHours])
            ->andWhere('ttl>0')
            ->andWhere(
                [
                    'not in','cachekey',$processedFiles
                ]
            )
            ->all()
        ) {
            foreach ($rows as $cache) {
                $file = @unserialize($cache->object);
                if (!in_array($cache->cacheKey, $processedFiles)) {
                    $processedFiles[] = $cache->cacheKey;
                    $file = $unistorageClient->getFile($file->resourceUri);
                    $unistorageClient->cacheFile($file, $cache->cacheKey);
                }
            }
        }
    }
}
