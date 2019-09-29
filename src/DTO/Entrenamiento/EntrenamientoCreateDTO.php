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
     * @JMSSerializer\Type("string")
     */
    protected $descripcion;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @JMSSerializer\Type("Entity<App\Entity\User>")
     */
    protected $user;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @JMSSerializer\Type("Entity<App\Entity\Rutina>")
     */
    protected $rutina;


    /**
     * EntrenamientoCreateDTO constructor.
     * @param $uuid
     * @param $descripcion
     * @param $user
     */
    public function __construct($uuid,$descripcion,$user,$rutina)
    {
        $this->uuid = $uuid;
        $this->descripcion = $descripcion;

        $this->user = $user;
        $this->rutina = $rutina;
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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getRutina()
    {
        return $this->rutina;
    }


}
