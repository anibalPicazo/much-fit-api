<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubgrupoMuscularRepository")
 */
class SubgrupoMuscular
{
    use UuidTrait;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}
