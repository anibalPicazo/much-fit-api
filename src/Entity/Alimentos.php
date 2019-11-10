<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AlimentosRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class Alimentos
{
    use UuidTrait;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     *
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MarcaAlimento", inversedBy="alimentos")
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $marca_alimento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $descripcion_eng;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion_cientifica;
    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $energia_kcal;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $energia_kj;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $grasas;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $grasas_ms;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $grasas_poli;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $grasas_saturadas;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $carbohidratos;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $carbohidratos_azucar;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $fibra;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $proteina;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $sal;



    public function __construct()
    {

    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getMarcaAlimento(): ?MarcaAlimento
    {
        return $this->marca_alimento;
    }

    public function setMarcaAlimento(?MarcaAlimento $marca_alimento): self
    {
        $this->marca_alimento = $marca_alimento;

        return $this;
    }

    public function getDescripcionEng(): ?string
    {
        return $this->descripcion_eng;
    }

    public function setDescripcionEng(?string $descripcion_eng): self
    {
        $this->descripcion_eng = $descripcion_eng;

        return $this;
    }

    public function getDescripcionCientifica(): ?string
    {
        return $this->descripcion_cientifica;
    }

    public function setDescripcionCientifica(?string $descripcion_cientifica): self
    {
        $this->descripcion_cientifica = $descripcion_cientifica;

        return $this;
    }

    public function getEnergiaKcal()
    {
        return $this->energia_kcal;
    }

    public function setEnergiaKcal($energia_kcal): self
    {
        $this->energia_kcal = $energia_kcal;

        return $this;
    }

    public function getEnergiaKj(): ?string
    {
        return $this->energia_kj;
    }

    public function setEnergiaKj(?string $energia_kj): self
    {
        $this->energia_kj = $energia_kj;

        return $this;
    }

    public function getGrasas()
    {
        return $this->grasas;
    }

    public function setGrasas($grasas): self
    {
        $this->grasas = $grasas;

        return $this;
    }

    public function getGrasasMs()
    {
        return $this->grasas_ms;
    }

    public function setGrasasMs($grasas_ms): self
    {
        $this->grasas_ms = $grasas_ms;

        return $this;
    }

    public function getGrasasPoli()
    {
        return $this->grasas_poli;
    }

    public function setGrasasPoli($grasas_poli): self
    {
        $this->grasas_poli = $grasas_poli;

        return $this;
    }

    public function getGrasasSaturadas()
    {
        return $this->grasas_saturadas;
    }

    public function setGrasasSaturadas($grasas_saturadas): self
    {
        $this->grasas_saturadas = $grasas_saturadas;

        return $this;
    }

    public function getCarbohidratos()
    {
        return $this->carbohidratos;
    }

    public function setCarbohidratos($carbohidratos): self
    {
        $this->carbohidratos = $carbohidratos;

        return $this;
    }

    public function getCarbohidratosAzucar()
    {
        return $this->carbohidratos_azucar;
    }

    public function setCarbohidratosAzucar($carbohidratos_azucar): self
    {
        $this->carbohidratos_azucar = $carbohidratos_azucar;

        return $this;
    }

    public function getFibra()
    {
        return $this->fibra;
    }

    public function setFibra($fibra): self
    {
        $this->fibra = $fibra;

        return $this;
    }

    public function getProteina()
    {
        return $this->proteina;
    }

    public function setProteina($proteina): self
    {
        $this->proteina = $proteina;

        return $this;
    }

    public function getSal()
    {
        return $this->sal;
    }

    public function setSal($sal): self
    {
        $this->sal = $sal;

        return $this;
    }

}
