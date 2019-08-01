<?php

namespace App\Service;

use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Role\RoleHierarchy as BaseRoleHierarchy;


class RoleHierarchy extends BaseRoleHierarchy
{

    private $em;

    /**
     * @param array $hierarchy
     * @param EntityManagerInterface $em
     */
    public function __construct(array $hierarchy, EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct($this->buildRolesTree());
    }

    /**
     * Here we build an array with roles. It looks like a two-levelled tree - just
     * like original Symfony roles are stored in security.yml
     * @return array
     */
    private function buildRolesTree()
    {
        $hierarchy = array();
        $roles = $this->em->getRepository(Role::class)->findAll();
        foreach ($roles as $role) {
            /** @var $role Role */
            if ($role->getParent()) {
                if (!isset($hierarchy[$role->getParent()->getName()])) {
                    $hierarchy[$role->getParent()->getName()] = array();
                }
                $hierarchy[$role->getParent()->getName()][] = $role->getName();
            } else {
                if (!isset($hierarchy[$role->getName()])) {
                    $hierarchy[$role->getName()] = array();
                }
            }
        }
        return $hierarchy;
    }


}
