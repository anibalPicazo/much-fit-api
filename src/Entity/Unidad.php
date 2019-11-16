<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UnidadRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class Unidad
{
    use UuidTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose()
     * @Serializer\Groups({"list"})
     */
    private $iniciales;

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

    public function getIniciales(): ?string
    {
        return $this->iniciales;
    }

    public function setIniciales(?string $iniciales): self
    {
        $this->iniciales = $iniciales;

        return $this;
    }
}
