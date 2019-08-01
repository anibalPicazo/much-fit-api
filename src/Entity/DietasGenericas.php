<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DietasGenericasRepository")
 */
class DietasGenericas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DesayunoDieta", inversedBy="dietasGenericas")
     */
    private $desayuno;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AlmuerzoDieta", inversedBy="dietasGenericas")
     */
    private $almuerzo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ComidaDieta", inversedBy="dietasGenericas")
     */
    private $comida;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MeriendaDieta", inversedBy="dietasGenericas")
     */
    private $meriendaDieta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CenaDieta", inversedBy="dietasGenericas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cenaDieta;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $aporte_calorico_diario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proteina;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nivel_carbohidratos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nivel_grasas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getDesayuno(): ?DesayunoDieta
    {
        return $this->desayuno;
    }

    public function setDesayuno(?DesayunoDieta $desayuno): self
    {
        $this->desayuno = $desayuno;

        return $this;
    }

    public function getAlmuerzo(): ?AlmuerzoDieta
    {
        return $this->almuerzo;
    }

    public function setAlmuerzo(?AlmuerzoDieta $almuerzo): self
    {
        $this->almuerzo = $almuerzo;

        return $this;
    }

    public function getComida(): ?ComidaDieta
    {
        return $this->comida;
    }

    public function setComida(?ComidaDieta $comida): self
    {
        $this->comida = $comida;

        return $this;
    }

    public function getMeriendaDieta(): ?MeriendaDieta
    {
        return $this->meriendaDieta;
    }

    public function setMeriendaDieta(?MeriendaDieta $meriendaDieta): self
    {
        $this->meriendaDieta = $meriendaDieta;

        return $this;
    }

    public function getCenaDieta(): ?CenaDieta
    {
        return $this->cenaDieta;
    }

    public function setCenaDieta(?CenaDieta $cenaDieta): self
    {
        $this->cenaDieta = $cenaDieta;

        return $this;
    }

    public function getAporteCaloricoDiario()
    {
        return $this->aporte_calorico_diario;
    }

    public function setAporteCaloricoDiario($aporte_calorico_diario): self
    {
        $this->aporte_calorico_diario = $aporte_calorico_diario;

        return $this;
    }

    public function getProteina(): ?string
    {
        return $this->proteina;
    }

    public function setProteina(string $proteina): self
    {
        $this->proteina = $proteina;

        return $this;
    }

    public function getNivelCarbohidratos(): ?string
    {
        return $this->nivel_carbohidratos;
    }

    public function setNivelCarbohidratos(string $nivel_carbohidratos): self
    {
        $this->nivel_carbohidratos = $nivel_carbohidratos;

        return $this;
    }

    public function getNivelGrasas(): ?string
    {
        return $this->nivel_grasas;
    }

    public function setNivelGrasas(string $nivel_grasas): self
    {
        $this->nivel_grasas = $nivel_grasas;

        return $this;
    }
}
