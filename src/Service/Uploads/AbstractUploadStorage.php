<?php


namespace App\Service\Uploads;


use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AbstractUploadStorage
{

    public function getUniqueFileName(UploadedFile $file){
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        return md5(uniqid()) . '-' . Urlizer::urlize($originalFilename) . '.' . $file->guessExtension();
    }
}
