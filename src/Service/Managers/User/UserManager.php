<?php


namespace App\Service\Managers\User;

use App\DTO\User\UserCreateDTO;
use App\DTO\User\UserRegisterDTO;
use App\Entity\Role;
use App\Entity\User;
use App\Serializer\ApiRestErrorNormalizer;
use App\Service\Forms\DTOFormFactory;
use App\Service\Managers\AbstractManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use function Lambdish\phunctional\map;

class UserManager extends AbstractManager
{
    /**
     * @return object|string
     */
    public function getCurrent()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    /**
     * @param UserCreateDTO $DTO
     * @return User
     */
    public function createUser(UserCreateDTO $DTO)
    {
        $user = new User();
        $user->setUuid($DTO->getUuid());
        $user->setUsername($DTO->getUsername());
        $user->setPassword($this->encoder->encodePassword($user, $DTO->getPassword()));
        $user->setEmail($DTO->getEmail());
        foreach ($DTO->getRoles() as $role){
            $user->addRole($role);
        }

        $this->save($user);

        return $user;
    }


    public function register(UserRegisterDTO $DTO)
    {
        $user = new User();
        $user->setUuid($DTO->getUuid());
        $user->setUsername($DTO->getUsername());
        $user->setEmail($DTO->getEmail());
        $user->setName($DTO->getName());
        $user->setSurname($DTO->getSurname());
        $user->setPassword($this->encoder->encodePassword($user, $DTO->getPassword()));
        $role = $this->doctrine->getRepository(Role::class)->findOneBy(['name'=>Role::ROLE_USER]);
        $user->addRole($role);
        $this->save($user);
        return $user;

    }

    protected function getRepository()
    {
        return $this->doctrine->getRepository(User::class);
    }

}
