<?php


namespace App\DTO\Entrenamiento;


use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class EntrenamientoCreateDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @JMSSerializer\Type("string")
     */
    protected $uuid;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @JMSSerializer\Type("Entity<App\Entity\User>")
     */
    protected $descripcion;

    /**
     * EntrenamientoCreateDTO constructor.
     * @param $uuid
     * @param $descripcion
     */
    public function __construct($uuid,$descripcion)
    {
        $this->uuid = $uuid;
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

}
