<?php


namespace App\DTO\User;

use App\DTO\DTOInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerializer;

class UserCreateDTO implements DTOInterface
{

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    private $username;

    /**
     * @Assert\NotNull()
     * @Assert\Email()
     * @JMSSerializer\Type("string")
     */
    private $email;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    private $password;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\Role,collection>")
     */
    private $roles;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    private $uuid;

    /**
     * UserCreateDTO constructor.
     * @param $uuid
     * @param $username
     * @param $email
     * @param $plain_password
     * @param $roles
     */
    public function __construct($uuid, $username, $email, $plain_password, $roles)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $plain_password;
        $this->roles = $roles;
        $this->uuid = $uuid;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }


}
