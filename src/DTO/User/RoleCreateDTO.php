<?php


namespace App\DTO\User;

use App\DTO\DTOInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerializer;

class RoleCreateDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    private $uuid;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    private $name;

    /**
     * @JMSSerializer\Type("Entity<App\Entity\Role>")
     */
    private $parent;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * UserCreateDTO constructor.
     * @param $uuid
     * @param $name
     * @param $parent
     */
    public function __construct($uuid, $name, $parent)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }


}
