<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Fixtures extends BaseFixtures implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {


        #ROLE ROOT
        $roleAdmin = new Role();
        $roleAdmin->setUuid(Uuid::uuid4()->toString());
        $roleAdmin->setName(Role::ROLE_ROOT);

        #ROLE_USER
        $roleUser = new Role();
        $roleUser->setUuid(Uuid::uuid4()->toString());
        $roleUser->setName(Role::ROLE_USER);
        $manager->persist($roleUser);

        $roleAdmin->addChild($roleUser);
        $manager->persist($roleAdmin);


        #ADMIN
        $admin = new User();
        $admin->setUuid(Uuid::uuid4()->toString());
        $admin->setEmail('admin@admin.com');
        $admin->setUsername('admin');
        $admin->setPassword($this->encoder->encodePassword($admin, 'admin'));
        $admin->addRole($roleAdmin);
        $manager->persist($admin);


        #USER
        $user = new User();
        $user->setUuid(Uuid::uuid4()->toString());
        $user->setEmail('demo@demo.com');
        $user->setUsername('demo');
        $user->setPassword($this->encoder->encodePassword($admin, 'demo'));
        $user->addRole($roleUser);
        $manager->persist($user);


        $manager->flush();
    }

}
