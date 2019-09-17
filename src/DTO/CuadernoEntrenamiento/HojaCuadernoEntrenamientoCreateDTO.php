<?php


namespace App\DTO\CuadernoEntrenamiento;


use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class HojaCuadernoEntrenamientoCreateDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $uuid;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\Rutina")
     */
    protected $rutina;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\Rutina")
     */
    protected $cuaderno_entrenamiento;

    /**
     * HojaCuadernoEntrenamientoCreateDTO constructor.
     * @param $uuid
     * @param $rutina
     * @param $cuaderno_entrenamiento
     */
    public function __construct($uuid, $rutina,$cuaderno_entrenamiento)
    {
        $this->uuid = $uuid;
        $this->rutina = $rutina;
        $this->cuaderno_entrenamiento = $cuaderno_entrenamiento;
    }

    /**
     * @return mixed
     */
    public function getRutina()
    {
        return $this->rutina;
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
    public function getCuadernoEntrenamiento()
    {
        return $this->cuaderno_entrenamiento;
    }

}
