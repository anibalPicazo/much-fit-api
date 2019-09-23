<?php


namespace App\DTO\Rutina;


use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class DiaEjercicioCreateDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $uuid;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App/Entity/Ejercicio>")
     */
    protected $ejercicio;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $serie;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $repeticiones;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $descanso;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $intesidad;


    public function __construct($uuid, $ejercicio, $serie, $repeticiones,$descanso,$intesidad)
    {
        $this->uuid = $uuid;
        $this->ejercicio = $ejercicio;
        $this->serie = $serie;
        $this->repeticiones = $repeticiones;
        $this->descanso = $descanso;
        $this->intesidad = $intesidad;
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
    public function getEjercicio()
    {
        return $this->ejercicio;
    }

    /**
     * @return mixed
     */
    public function getIntesidad()
    {
        return $this->intesidad;
    }

    /**
     * @return mixed
     */
    public function getDescanso()
    {
        return $this->descanso;
    }

    /**
     * @return mixed
     */
    public function getRepeticiones()
    {
        return $this->repeticiones;
    }

    /**
     * @return mixed
     */
    public function getSerie()
    {
        return $this->serie;
    }
}
