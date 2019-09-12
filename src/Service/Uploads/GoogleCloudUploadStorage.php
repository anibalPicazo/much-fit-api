<?php


namespace App\Service\Uploads;


use Google\Cloud\Storage\Bucket;
use Google\Cloud\Storage\StorageClient;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GoogleCloudUploadStorage extends AbstractUploadStorage implements UploadStorageInterface
{

    /**
     * @var Bucket
     */
    private $bucket;

    public function __construct($bucket_name, $project_id, $key_json)
    {
        $storage = new StorageClient(
            [
                'projectId' => $project_id,
                'keyFile' => json_decode($key_json, true)
            ]
        );
        $this->bucket = $storage->bucket($bucket_name, $userProject = true);
    }

    public function save(UploadedFile $file)
    {
        try {
            $fileName = $this->getUniqueFileName($file);
            $object = $this->bucket->upload(fopen($file, 'r'), [
                'name' => $fileName,
                'predefinedAcl' => 'publicRead'
            ]);

            return $fileName;
        } catch (\Exception $e) {
            dump('error: ');
            dump($e->getMessage());
            die;
        }
    }

    public function get($ref)
    {
        $object = $this->bucket->object($ref);
        return $object->downloadAsStream();
    }

    public function delete($ref)
    {
        $object = $this->bucket->object($ref);
        $object->delete();
    }

}
