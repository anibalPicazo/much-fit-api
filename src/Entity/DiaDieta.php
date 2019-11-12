<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiaDietaRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class DiaDieta
{
    use UuidTrait;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose()
     * @Serializer\Groups({"edit"})
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dieta", inversedBy="dias_dieta")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dieta;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Meal", mappedBy="dia_dieta")
     * @Serializer\Expose()
     * @Serializer\Groups({"edit"})
     *
     */
    private $meals;

    public function __construct()
    {
        $this->meals = new ArrayCollection();
    }

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

    public function getDieta(): ?Dieta
    {
        return $this->dieta;
    }

    public function setDieta(?Dieta $dieta): self
    {
        $this->dieta = $dieta;

        return $this;
    }

    /**
     * @return Collection|Meal[]
     */
    public function getMeals(): Collection
    {
        return $this->meals;
    }

    public function addMeal(Meal $meal): self
    {
        if (!$this->meals->contains($meal)) {
            $this->meals[] = $meal;
            $meal->setDiaDieta($this);
        }

        return $this;
    }

    public function removeMeal(Meal $meal): self
    {
        if ($this->meals->contains($meal)) {
            $this->meals->removeElement($meal);
            // set the owning side to null (unless already changed)
            if ($meal->getDiaDieta() === $this) {
                $meal->setDiaDieta(null);
            }
        }

        return $this;
    }
}
