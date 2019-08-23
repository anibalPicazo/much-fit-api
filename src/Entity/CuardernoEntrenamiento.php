<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CuardernoEntrenamientoRepository")
 */
class CuardernoEntrenamiento
{
    use UuidTrait;
    use TimestampableTrait;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="cuardernoEntrenamiento", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }


}
