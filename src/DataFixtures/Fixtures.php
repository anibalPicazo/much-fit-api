<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\TestUsuario;
use App\Entity\TestUsuarioDieta;
use App\Entity\TipoFisico;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Self_;
use Ramsey\Uuid\Uuid;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Fixtures extends BaseFixtures implements ContainerAwareInterface
{
    const USER = 'user';
    const ESTADO_FISICO = ['MALO','NORMAL','BUENO'];
    const EXPERIENCIA = ['ALTA','MUY ALTA','INTERMEDIO','BAJO'];
    const FRECUENCIA = ['< 2','2 - 3','> 3'];
    const ESTADO_ACTUAL = ['DEFINIDO','SOBREPESO','DELGADO','LIGERAMENTE SOBREPESO','EXTREMA DELGADEZ','MUSCULOSO'];
    const OBJETIVO_METABOLICO = ['DEFINIDO','MUSCULOSO','NORMAL'];
    const ACTIVIDAD_FISICA = ['POCA','NORMAL','ALTA','MUY ALTA'];

    //QUANTITY
    const USUARIOS = 40;


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


        #USER ADMIN
        $user = new User();
        $user->setUuid(Uuid::uuid4()->toString());
        $user->setEmail('demo@demo.com');
        $user->setUsername('demo');
        $user->setPassword($this->encoder->encodePassword($admin, 'admin'));
        $user->addRole($roleUser);
        $manager->persist($user);
        #USERS
        $this->createMany(User::class, self::USUARIOS, function (User $user, $count) use($roleUser)  {
            $user->setName($this->faker->sentence(14, 8));
            $user->setSurname($this->faker->lastName);
            $user->setUuid(Uuid::uuid4()->toString());
            $user->setEmail($this->faker->email);
            $user->setPhoto('https://randomuser.me/api/portraits/men/'.$count.'jpg');
            $user->setPassword($this->encoder->encodePassword($user, 'usuario'.$count));
            $user->setActivo(true);
            $user->addRole($roleUser);
            $this->addReference(self::USER . $count, $user);
        });

        #TEST USUARIO
        //todo: Create many test usuario
        $this->createMany(TestUsuario::class,self::USUARIOS,function(TestUsuario $testUsuario, $count){
           $testUsuario->setUuid(Uuid::uuid4()->toString());
           $testUsuario->setExperienciaDeporte($this->faker->randomElement(self::EXPERIENCIA));
           $testUsuario->setFormaFisica($this->faker->randomElement(self::ESTADO_FISICO));
           $testUsuario->setFrecuenciaEntrenamiento($this->faker->randomElement(self::FRECUENCIA));
           $testUsuario->setUser($this->getReference(self::USER.$count));
        });

        #TEST USUARIO DIETA

        $this->createMany(TestUsuarioDieta::class,self::USUARIOS,function(TestUsuarioDieta $testUsuarioDieta, $count){
            $testUsuarioDieta->setUuid(Uuid::uuid4()->toString());
            $testUsuarioDieta->setAltura($this->faker->randomFloat(null,1.40,2.10));
            $testUsuarioDieta->setPeso($this->faker->randomFloat(null,40,110));
            $testUsuarioDieta->setGenero($this->faker->randomElement(['HOMBRE','MUJER']));
            $testUsuarioDieta->setEdad($this->faker->numberBetween(16,80));
            $testUsuarioDieta->setEstadoFisico($this->faker->randomElement(self::ESTADO_ACTUAL));
            $testUsuarioDieta->setEstadoFisicoObjetivo($this->faker->randomElement(self::OBJETIVO_METABOLICO));
            $testUsuarioDieta->setActividadFisica($this->faker->randomElement(self::ACTIVIDAD_FISICA));
            $testUsuarioDieta->setUser($this->getReference(self::USER.$count));

        });

        $manager->flush();
    }

}
