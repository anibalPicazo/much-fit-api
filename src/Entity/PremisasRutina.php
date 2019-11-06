<?php

namespace App\Entity;

use App\Entity\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PremisasRutinaRepository")
 */
class PremisasRutina
{
    use UuidTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hint;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ruleCode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHint(): ?string
    {
        return $this->hint;
    }

    public function setHint(string $hint): self
    {
        $this->hint = $hint;

        return $this;
    }

    public function getRuleCode(): ?string
    {
        return $this->ruleCode;
    }

    public function setRuleCode(string $ruleCode): self
    {
        $this->ruleCode = $ruleCode;

        return $this;
    }
}
