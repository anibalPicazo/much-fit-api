<?php


namespace App\DTO\Rutina;


use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class DiaCreateDTO implements  DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $uuid;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $nombre;


    /**
     * DiaCreateDTO constructor.
     * @param $uuid
     * @param $nombre
     * @param $diaEjercicios
     */
    public function __construct($uuid, $nombre)
    {
        $this->uuid = $uuid;
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

}
