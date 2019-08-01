<?php


namespace App\Service\Managers\User;

use App\DTO\User\AsignarEmpresaDTO;
use App\DTO\User\UserCreateDTO;
use App\Entity\User;
use App\Serializer\ApiRestErrorNormalizer;
use App\Service\Forms\DTOFormFactory;
use App\Service\Managers\AbstractManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager extends AbstractManager
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * UserManager constructor.
     * @param UserPasswordEncoderInterface $encoder
     * @param ApiRestErrorNormalizer $normalizer
     * @param DTOFormFactory $formFactory
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(UserPasswordEncoderInterface $encoder, ApiRestErrorNormalizer $normalizer, DTOFormFactory $formFactory, EntityManagerInterface $doctrine, TokenStorageInterface $tokenStorage)
    {
        parent::__construct($normalizer, $formFactory, $doctrine, $tokenStorage);
        $this->encoder = $encoder;
    }

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
        $user->setEmpresa($this->tokenStorage->getToken()->getUser()->getEmpresa());

        foreach ($DTO->getRoles() as $role) {
            $user->addRole($role);
        }

        $this->save($user);

        return $user;
    }

    public function asignarEmpresa(AsignarEmpresaDTO $DTO)
    {
        /** @var User $user */
        $user = $DTO->getUser();
        $user->setEmpresa($DTO->getEmpresa());

        $this->doctrine->persist($user);
        $this->doctrine->flush();

        return $user;
    }

    protected function getRepository()
    {
        return $this->doctrine->getRepository(User::class);
    }

}
