<?php

namespace Rumguru\Model;


use Nette\Http\FileUpload;
use Nette\Utils\Image;

class RumImage
{

    public function saveImage(FileUpload $upload)
    {
        $name = $upload->getSanitizedName();
        $dir = substr(md5($name), 0, 2);
        $this->mkdir($dir);
        $filename = $dir . DIRECTORY_SEPARATOR . $name;

        $image = $upload->toImage();
        $image->resize(500, null);
        $image->save(UPLOAD_DIR . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }

    private function mkdir($dirName)
    {
        $dir = UPLOAD_DIR . DIRECTORY_SEPARATOR . $dirName;
        if (!is_dir($dir)) {
            mkdir($dir);
        }
    }

}