<?php


namespace App\DTO\TestUsuario;


use App\DTO\DTOInterface;
use App\Entity\User;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;



class TestUsuarioCreateDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("Entity<App\Entity\User>")
     */
    protected $user;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("String")
     */
    private $altura;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("double")
     */
    private $peso;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("string")
     */
    private $genero;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("double")
     */
    private $porcentaje_grasa;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("boolean")
     */
    private $diabetico;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("boolean")
     */
    private $celiaco;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("string")
     */
    private $composicion_atletica;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("string")
     */
    private $frecuencia_entrenamiento;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("string")
     */
    private $experiencia_deporte;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("string")
     */
    private $adherencia_dieta;
    /**
     * @Assert\NotNull()
     * @Assert\NotBlank
     * @Serializer\Type("string")
     */
    private $adherencia_deporte;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    private $uuid;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("array")
     */
    private $diasEntrenamiento;

    /**
     * TestUsuarioCreateDTO constructor.
     * @param $uuid
     * @param User $user
     * @param $altura
     * @param $peso
     * @param $genero
     * @param $porcentaje_grasa
     * @param $diabetico
     * @param $celiaco
     * @param $composicion_atletica
     * @param $frecuencia_entrenamiento
     * @param $experiencia_deporte
     * @param $adherencia_dieta
     * @param $adherencia_deporte
     * @param $diasEntrenamiento
     */
    public function __construct($uuid,$user,$altura,$peso,$genero,$porcentaje_grasa,
                                $diabetico,$celiaco,$composicion_atletica,
                                $frecuencia_entrenamiento,$experiencia_deporte,
                                $adherencia_dieta,$adherencia_deporte,$diasEntrenamiento)
    {
        $this->uuid = $uuid;
        $this->user = $user;
        $this->altura = $altura;
        $this->peso = $peso;
        $this->genero = $genero;
        $this->porcentaje_grasa = $porcentaje_grasa;
        $this->diabetico = $diabetico;
        $this->celiaco = $celiaco;
        $this->composicion_atletica = $composicion_atletica;
        $this->frecuencia_entrenamiento = $frecuencia_entrenamiento;
        $this->experiencia_deporte = $experiencia_deporte;
        $this->adherencia_dieta = $adherencia_dieta;
        $this->adherencia_deporte = $adherencia_deporte;
        $this->diasEntrenamiento = $diasEntrenamiento;
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
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * @return mixed
     */
    public function getAdherenciaDeporte()
    {
        return $this->adherencia_deporte;
    }

    /**
     * @return mixed
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * @return mixed
     */
    public function getAdherenciaDieta()
    {
        return $this->adherencia_dieta;
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
    public function getFrecuenciaEntrenamiento()
    {
        return $this->frecuencia_entrenamiento;
    }

    /**
     * @return mixed
     */
    public function getComposicionAtletica()
    {
        return $this->composicion_atletica;
    }

    /**
     * @return mixed
     */
    public function getDiabetico()
    {
        return $this->diabetico;
    }

    /**
     * @return mixed
     */
    public function getPorcentajeGrasa()
    {
        return $this->porcentaje_grasa;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
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
    public function getDiasEntrenamiento()
    {
        return $this->diasEntrenamiento;
    }

    /**
     * @return mixed
     */
    public function getCeliaco()
    {
        return $this->celiaco;
    }

}
