<?php
namespace Checkout\Util;

use Laminas\File\Transfer\Adapter\Http;
use Laminas\Validator\File\IsImage;
use Laminas\Filter\File\RenameUpload;
class Util
{
    public static function uploadImage($object = null){

        $adapter = new Http();
        if ($adapter->isValid()) {
            $newFilename = md5(uniqid()) . '.' . pathinfo($adapter->getFileName(), PATHINFO_EXTENSION);

            $adapter->addFilter('Rename', ['target' => 'public/uploads/' . $newFilename, 'overwrite' => true]);

            if ($adapter->receive()) {
                 $object = $newFilename;
            }
            return $object;
        }
    }
}