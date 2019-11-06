<?php


namespace App\DTO\TestUsuario;


use App\DTO\DTOInterface;

class TestNutricionalCreateDTO implements DTOInterface
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
    protected $altura;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $edad;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $genero;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $imc;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $grasa;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $peso;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $estado_fisico;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $estado_fisico_objetivo;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    private $actividad_fisica;

    /**
     * TestNutricionalCreateDTO constructor.
     * @param $uuid
     * @param $altura
     * @param $edad
     * @param $genero
     * @param $imc
     * @param $grasa
     * @param $peso
     * @param $estado_fisico
     * @param $estado_fisico_objetivo
     * @param $actividad_fisica
     */
    public function __construct($uuid, $altura, $edad, $genero, $imc, $grasa, $peso, $estado_fisico, $estado_fisico_objetivo, $actividad_fisica)
    {
        $this->uuid = $uuid;
        $this->altura = $altura;
        $this->edad = $edad;
        $this->genero = $genero;
        $this->imc = $imc;
        $this->grasa = $grasa;
        $this->peso = $peso;
        $this->estado_fisico = $estado_fisico;
        $this->estado_fisico_objetivo = $estado_fisico_objetivo;
        $this->actividad_fisica = $actividad_fisica;
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
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * @return mixed
     */
    public function getEdad()
    {
        return $this->edad;
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
    public function getImc()
    {
        return $this->imc;
    }

    /**
     * @return mixed
     */
    public function getGrasa()
    {
        return $this->grasa;
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
    public function getEstadoFisico()
    {
        return $this->estado_fisico;
    }

    /**
     * @return mixed
     */
    public function getEstadoFisicoObjetivo()
    {
        return $this->estado_fisico_objetivo;
    }

    /**
     * @return mixed
     */
    public function getActividadFisica()
    {
        return $this->actividad_fisica;
    }

}
