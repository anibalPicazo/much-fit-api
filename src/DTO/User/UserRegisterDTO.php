<?php


namespace App\DTO\User;


use App\DTO\DTOInterface;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerializer;


class UserRegisterDTO implements DTOInterface
{
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $uuid;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $username;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $name;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $surname;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $email;
    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("string")
     */
    protected $password;

    /**
     * UserRegisterDTO constructor.
     * @param $uuid
     * @param $username
     * @param $name
     * @param $surname
     * @param $email
     * @param $password
     */
    public function __construct($uuid, $username, $name, $surname, $email, $password)
    {
        $this->uuid = $uuid;
        $this->username = $username;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
    public function getSurname()
    {
        return $this->surname;
    }

}
