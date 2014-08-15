<?php
namespace yii\unistorage\Models;

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
            array('cacheKey', 'string', 'min' => 32, 'max' => 32),
            array('ttl', 'number', 'integerOnly' => true, 'min' => 0),
            array('object', 'safe'),
        );
    }
}
