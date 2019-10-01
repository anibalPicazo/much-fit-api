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
     * @JMSSerializer\Type("Entity<App\Entity\Ejercicios>")
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

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\Dia>")
     */
    protected $dia;


    /**
     * DiaEjercicioCreateDTO constructor.
     * @param $uuid
     * @param $ejercicio
     * @param $serie
     * @param $repeticiones
     * @param $descanso
     * @param $intesidad
     * @param $dia
     */
    public function __construct($uuid, $ejercicio, $serie, $repeticiones, $descanso, $intesidad,$dia)
    {
        $this->uuid = $uuid;
        $this->ejercicio = $ejercicio;
        $this->serie = $serie;
        $this->repeticiones = $repeticiones;
        $this->descanso = $descanso;
        $this->intesidad = $intesidad;
        $this->dia = $dia;
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


    /**
     * @return mixed
     */
    public function getDia()
    {
        return $this->dia;
    }
}
