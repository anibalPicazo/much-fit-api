<?php


namespace App\Entity\Traits;


use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

trait UuidTrait
{


    /**
     * The internal primary identity key.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=36, unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     * @Serializer\Expose()
     * @Serializer\Groups({"list-custom","list"})
     */
    protected $uuid;

    /**
     * The unique auto incremented primary key.
     *
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned": true})
     * @ORM\GeneratedValue
     */
    protected $id;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param $uuid
     * @return string
     */
    public function setUuid($uuid)
    {
        return $this->uuid = $uuid;
    }

}
