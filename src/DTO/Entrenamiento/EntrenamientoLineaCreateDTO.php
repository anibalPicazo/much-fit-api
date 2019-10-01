<?php


namespace App\DTO\Entrenamiento;


use App\DTO\DTOInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerializer;


class EntrenamientoLineaCreateDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $uuid;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\Ejercicio>")
     */
    protected  $ejercicio;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("integer")
     */
    protected  $repeticiones;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected  $serie;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("float")
     */
    protected  $kilos;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\Entrenamiento")
     */
    protected  $entrenamiento;

    public function __construct($uuid, $ejercicio, $repeticiones, $serie, $kilos, $entrenamiento)
    {
        $this->uuid = $uuid;
        $this->ejercicio = $ejercicio;
        $this->repeticiones = $repeticiones;
        $this->serie = $serie;
        $this->kilos = $kilos;
        $this->entrenamiento = $entrenamiento;
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
    /**
     * @return mixed
     */
    public function getEntrenamiento()
    {
        return $this->entrenamiento;
    }
    /**
     * @return mixed
     */
    public function getKilos()
    {
        return $this->kilos;
    }
}
