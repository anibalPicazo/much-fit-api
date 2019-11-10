<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MealRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class Meal
{
    use UuidTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Alimentos")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $alimento;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $cantidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Unidad")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $unidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DiaDieta", inversedBy="meals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dia_dieta;

    //todo: Propiedades virtuales de los macros.




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlimento(): ?Alimentos
    {
        return $this->alimento;
    }

    public function setAlimento(?Alimentos $alimento): self
    {
        $this->alimento = $alimento;

        return $this;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }



    public function getUnidad(): ?Unidad
    {
        return $this->unidad;
    }

    public function setUnidad(?Unidad $unidad): self
    {
        $this->unidad = $unidad;

        return $this;
    }

    public function getDiaDieta(): ?DiaDieta
    {
        return $this->dia_dieta;
    }

    public function setDiaDieta(?DiaDieta $dia_dieta): self
    {
        $this->dia_dieta = $dia_dieta;

        return $this;
    }
}
