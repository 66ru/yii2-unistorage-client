<?php

namespace yii\unistorage\Models\Files;

use Yii;
use Unistorage\Models\Files\File;
use Unistorage\Models\Template;
use Unistorage\Unistorage;

class AudioFile extends \Unistorage\Models\Files\AudioFile
{
    /**
     * @param string     $format
     * @param bool       $lowPriority
     * @param Unistorage $unistorage
     *
     * @return File
     */
    public function convert($format, $lowPriority = false, $unistorage = null)
    {
        $unistorage = Yii::$app->unistorage;
        return parent::convert($format, $lowPriority, $unistorage);
    }

    /**
     * @param Template   $template
     * @param bool       $lowPriority
     * @param Unistorage $unistorage
     *
     * @return File|bool
     */
    public function apply($template, $lowPriority = false, $unistorage = null)
    {
        $unistorage = Yii::$app->unistorage;
        return parent::apply($template, $lowPriority, $unistorage);
    }
}
