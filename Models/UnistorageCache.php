<?php
namespace yii\unistorage;

use yii\db\ActiveRecord;

/**
 * @property string $cacheKey
 * @property int    $ttl
 * @property string $object
 */
class UnistorageCache extends ActiveRecord
{

    public static function tableName()
    {
        return 'unistoragecache';
    }

    public function rules()
    {
        return array(
            array('cacheKey', 'length', 'min' => 32, 'max' => 32),
            array('ttl', 'numerical', 'integerOnly' => true, 'min' => 0),
            array('object', 'safe'),
        );
    }
}
