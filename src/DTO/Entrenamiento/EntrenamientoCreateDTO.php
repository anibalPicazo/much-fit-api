<?php


namespace App\DTO\Entrenamiento;


use App\DTO\DTOInterface;

class EntrenamientoCreateDTO implements DTOInterface
{
    protected $uuid;

    /**
     * EntrenamientoCreateDTO constructor.
     * @param $uuid
     */
    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

}
