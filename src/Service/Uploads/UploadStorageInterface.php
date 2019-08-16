<?php


namespace App\Service\Uploads;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface UploadStorageInterface
{

    public function save(UploadedFile $file);

    public function get($file_ref);

    public function delete($file_ref);

}
