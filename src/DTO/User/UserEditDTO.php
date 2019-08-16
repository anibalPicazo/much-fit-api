<?php


namespace App\DTO\User;

use App\DTO\DTOInterface;
use JMS\Serializer\Annotation as JMSSerializer;
use Symfony\Component\Validator\Constraints as Assert;

class UserEditDTO implements DTOInterface
{
    /**
     * @JMSSerializer\Type("string")
     */
    protected $password;

    /**
     * @Assert\NotNull()
     * @JMSSerializer\Type("Entity<App\Entity\User>")
     */
    private $user;

    /**
     * @JMSSerializer\Type("string")
     */
    protected $username;

    /**
     * @JMSSerializer\Type("boolean")
     */
    protected $activo;

    /**
     * @Assert\Email()
     * @JMSSerializer\Type("string")
     */
    protected $email;


    /**
     * UserCreateDTO constructor.
     * @param $activo
     * @param $username
     * @param $password
     * @param $email
     * @param $user
     */
    public function __construct($activo, $username, $email, $user)
    {
        $this->username = $username;
        $this->email = $email;
        $this->user = $user;
        $this->activo = $activo;
    }

    /**
     * @return mixed
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
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


}
