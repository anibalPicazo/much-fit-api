<?php


namespace App\DTO\TestUsuario;


use App\DTO\DTOInterface;
use App\Entity\User;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;



class TestUsuarioEntrenamientoCreateDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @JMSSerializer\Type("Entity<App\Entity\User>")
     */
    protected $user;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @JMSSerializer\Type("string")
     */
    protected $experiencia_deporte;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $uuid;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $forma_fisica;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("integer")
     */
    protected $frecuencia;


    /**
     * TestUsuarioEntrenamientoCreateDTO constructor.
     * @param $uuid
     * @param User $user
     * @param $experiencia_deporte
     * @param $frecuencia
     * @param $forma_fisica
     */
    public function __construct($uuid,$user,$experiencia_deporte,$frecuencia,$forma_fisica)
    {
        $this->uuid = $uuid;
        $this->user = $user;
        $this->experiencia_deporte = $experiencia_deporte;
        $this->forma_fisica = $forma_fisica;
        $this->frecuencia = $frecuencia;
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
    public function getExperienciaDeporte()
    {
        return $this->experiencia_deporte;
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
    public function getFormaFisica()
    {
        return $this->forma_fisica;
    }

    /**
     * @return mixed
     */
    public function getFrecuencia()
    {
        return $this->frecuencia;
    }


}
