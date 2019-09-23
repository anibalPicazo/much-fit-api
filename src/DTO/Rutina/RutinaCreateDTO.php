<?php


namespace App\DTO\Rutina;


use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class RutinaCreateDTO implements DTOInterface
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
    protected $descripcion;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $desgaste_calorico;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $dificultad_usuario;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $frecuencia;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $volumen;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("array")
     */
    protected $objetivos;

    public function __construct($uuid, $descripcion, $desgaste_calorico, $dificultad_usuario, $frecuencia, $volumen, $objetivos)
    {
        $this->uuid = $uuid;
        $this->descripcion = $descripcion;
        $this->desgaste_calorico = $desgaste_calorico;
        $this->dificultad_usuario = $dificultad_usuario;
        $this->frecuencia = $frecuencia;
        $this->volumen = $volumen;
        $this->objetivos = $objetivos;
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
    public function getDesgasteCalorico()
    {
        return $this->desgaste_calorico;
    }

    /**
     * @return mixed
     */
    public function getDificultadUsuario()
    {
        return $this->dificultad_usuario;
    }

    /**
     * @return mixed
     */
    public function getFrecuencia()
    {
        return $this->frecuencia;
    }

    /**
     * @return mixed
     */
    public function getVolumen()
    {
        return $this->volumen;
    }

    /**
     * @return mixed
     */
    public function getObjetivos()
    {
        return $this->objetivos;
    }

}
