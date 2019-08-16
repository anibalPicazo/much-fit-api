<?php


namespace App\Service\Uploads;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploadStorage extends AbstractUploadStorage implements UploadStorageInterface
{
    protected $file_uploads;

    /**
     * FileUploadStorage constructor.
     * @param $file_uploads
     */
    public function __construct($file_uploads)
    {
        $this->file_uploads = $file_uploads;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function save(UploadedFile $file)
    {
        $fileName = $this->getUniqueFileName($file);
        $file->move($this->file_uploads, $fileName);
        return (string)$fileName;
    }

    public function get($file_ref)
    {
        // TODO: Implement get() method.
    }

    public function delete($file_ref)
    {
        // TODO: Implement delete() method.
    }


}
