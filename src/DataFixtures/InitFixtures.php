<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InitFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * InitFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {


        #ROLE ADMIN
        $role = new Role();
        $role->setUuid(Uuid::uuid4()->toString());
        $role->setName('ROLE_ADMIN');
        $manager->persist($role);

        #ADMIN
        $admin = new User();
        $admin->setUuid(Uuid::uuid4()->toString());
        $admin->setEmail('admin@admin.com');
        $admin->setUsername('admin');
        $admin->setPassword($this->encoder->encodePassword($admin, 'admin'));
        $admin->addRole($role);
        $manager->persist($admin);

        #ROLE_EMPLOYEE
        $role_employee = new Role();
        $role_employee->setUuid(Uuid::uuid4()->toString());
        $role_employee->setName('ROLE_EMPLOYEE');
        $role_employee->setParent($role);
        $manager->persist($role_employee);

        #EMPLOYEE
        $employee = new User();
        $employee->setUuid(Uuid::uuid4()->toString());
        $employee->setEmail('demo@demo.com');
        $employee->setUsername('demo');
        $employee->setPassword($this->encoder->encodePassword($admin, 'demo'));
        $employee->addRole($role_employee);
        $manager->persist($employee);


        $manager->flush();
    }
}
