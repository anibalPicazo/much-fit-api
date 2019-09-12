<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DietaPersonalizadaRepository")
 */
class DietaPersonalizada
{
    Use UuidTrait;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="dietaPersonalizada", cascade={"persist", "remove"})
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DesayunoDieta")
     */
    private $desayuno;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AlmuerzoDieta")
     */
    private $almuerzo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AlmuerzoDieta")
     */
    private $comida;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MeriendaDieta")
     */
    private $merienda;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CenaDieta")
     */
    private $cena;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PostCenaDieta")
     */
    private $postcena;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PasabocasDieta")
     */
    private $pasabocas;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     */
    private $proteina;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     */
    private $carbohidratos;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     */
    private $grasas;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3)
     */
    private $sal;

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

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

    public function getComida(): ?AlmuerzoDieta
    {
        return $this->comida;
    }

    public function setComida(?AlmuerzoDieta $comida): self
    {
        $this->comida = $comida;

        return $this;
    }

    public function getMerienda(): ?MeriendaDieta
    {
        return $this->merienda;
    }

    public function setMerienda(?MeriendaDieta $merienda): self
    {
        $this->merienda = $merienda;

        return $this;
    }

    public function getCena(): ?CenaDieta
    {
        return $this->cena;
    }

    public function setCena(?CenaDieta $cena): self
    {
        $this->cena = $cena;

        return $this;
    }

    public function getPostcena(): ?PostCenaDieta
    {
        return $this->postcena;
    }

    public function setPostcena(?PostCenaDieta $postcena): self
    {
        $this->postcena = $postcena;

        return $this;
    }

    public function getPasabocas(): ?PasabocasDieta
    {
        return $this->pasabocas;
    }

    public function setPasabocas(?PasabocasDieta $pasabocas): self
    {
        $this->pasabocas = $pasabocas;

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

    public function getCarbohidratos()
    {
        return $this->carbohidratos;
    }

    public function setCarbohidratos($carbohidratos): self
    {
        $this->carbohidratos = $carbohidratos;

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
