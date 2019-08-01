<?php


namespace App\Service\Managers\User;


use App\DTO\User\RoleCreateDTO;
use App\Entity\Role;
use App\Repository\RoleRepository;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;

class RoleManager extends AbstractManager
{

    /**
     * @return RoleRepository|ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(Role::class);
    }

    /**
     * @param RoleCreateDTO $DTO
     * @return Role
     */
    public function createRole(RoleCreateDTO $DTO)
    {
        $role = new Role();
        $role->setUuid($DTO->getUuid());
        $role->setName($DTO->getName());
        $role->setParent($DTO->getParent());

        $this->save($role);

        return $role;
    }
}
