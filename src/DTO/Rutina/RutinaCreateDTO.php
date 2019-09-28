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
    protected $nombre;

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

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\IntensidadRutina>")
     */
    protected $intensidad;

    /**
     * RutinaCreateDTO constructor.
     * @param $uuid
     * @param $nombre
     * @param $desgaste_calorico
     * @param $dificultad_usuario
     * @param $frecuencia
     * @param $volumen
     * @param $objetivos
     * @param $intesidad
     */
    public function __construct($uuid, $nombre, $desgaste_calorico, $dificultad_usuario, $frecuencia, $volumen, $objetivos, $intensidad)
    {
        $this->uuid = $uuid;
        $this->nombre = $nombre;
        $this->desgaste_calorico = $desgaste_calorico;
        $this->dificultad_usuario = $dificultad_usuario;
        $this->frecuencia = $frecuencia;
        $this->volumen = $volumen;
        $this->objetivos = $objetivos;
        $this->intensidad = $intensidad;
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

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getIntensidad()
    {
        return $this->intensidad;
    }

}
