<?php

namespace App\DataFixtures;

use App\Entity\ActividadFisica;
use App\Entity\IntensidadRutina;
use App\Entity\Role;
use App\Entity\Rutina;
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
    const INTENSIDAD_ENTRENAMIENTO =["MUY ALTA","ALTA","MEDIA","BAJA","MUY BAJA"];

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
        $admin->setName('Anibal');
        $admin->setSurname('Picazo');
        $admin->setUsername('admin');
        $admin->setPassword($this->encoder->encodePassword($admin, 'admin'));
        $admin->addRole($roleAdmin);
        $manager->persist($admin);


        #USER ADMIN
        $user = new User();
        $user->setName('user');
        $user->setUuid(Uuid::uuid4()->toString());
        $user->setSurname('Picazo');
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
            $user->setUsername($this->faker->userName);
            $user->setEmail($this->faker->email);
            $user->setPhoto('https://randomuser.me/api/portraits/men/'.$count.'jpg');
            $user->setPassword($this->encoder->encodePassword($user, 'usuario'.$count));
            $user->setActivo(true);
            $user->addRole($roleUser);
            $this->addReference(self::USER . $count, $user);
        });
        #ACTIVIDAD FISICA

        $actividad_fisica_sedentario = new ActividadFisica();
        $actividad_fisica_sedentario->setUuid(Uuid::uuid4()->toString());
        $actividad_fisica_sedentario->setFactorCorrecionMetabolismoBasal(1.2);
        $actividad_fisica_sedentario->setNivel('SEDENTARIO');
        $manager->persist($actividad_fisica_sedentario);


        $actividad_fisica_ligeramente_activa = new ActividadFisica();
        $actividad_fisica_ligeramente_activa->setUuid(Uuid::uuid4()->toString());
        $actividad_fisica_ligeramente_activa->setFactorCorrecionMetabolismoBasal(1.375);
        $actividad_fisica_ligeramente_activa->setNivel('LIGERAMENTE ACTIVA');
        $manager->persist($actividad_fisica_ligeramente_activa);

        $actividad_fisica_modreadamente_activa = new ActividadFisica();
        $actividad_fisica_modreadamente_activa->setUuid(Uuid::uuid4()->toString());
        $actividad_fisica_modreadamente_activa->setFactorCorrecionMetabolismoBasal(1.55);
        $actividad_fisica_modreadamente_activa->setNivel('MODERADEMENTE ACTIVA');
        $manager->persist($actividad_fisica_modreadamente_activa);

        $actividad_fisica_muy_activas = new ActividadFisica();
        $actividad_fisica_muy_activas->setUuid(Uuid::uuid4()->toString());
        $actividad_fisica_muy_activas->setFactorCorrecionMetabolismoBasal(1.726);
        $actividad_fisica_muy_activas->setNivel('MUY ACTIVAS');
        $manager->persist($actividad_fisica_muy_activas);


        $actividad_fisica_hiperactivas = new ActividadFisica();
        $actividad_fisica_hiperactivas->setUuid(Uuid::uuid4()->toString());
        $actividad_fisica_hiperactivas->setFactorCorrecionMetabolismoBasal(1.9);
        $actividad_fisica_hiperactivas->setNivel('HIPERACTIVAS');
        $manager->persist($actividad_fisica_hiperactivas);

        #TEST USUARIO
        $this->createMany(TestUsuario::class,self::USUARIOS,function(TestUsuario $testUsuario, $count){
           $testUsuario->setUuid(Uuid::uuid4()->toString());
           $testUsuario->setExperienciaDeporte($this->faker->randomElement(self::EXPERIENCIA));
           $testUsuario->setFormaFisica($this->faker->randomElement(self::ESTADO_FISICO));
           $testUsuario->setFrecuenciaEntrenamiento($this->faker->randomElement(self::FRECUENCIA));
           $testUsuario->setUser($this->getReference(self::USER.$count));
        });


        #TEST USUARIO DIETA

        $this->createMany(TestUsuarioDieta::class,self::USUARIOS,function(TestUsuarioDieta $testUsuarioDieta, $count)
        use($actividad_fisica_hiperactivas,$actividad_fisica_muy_activas,$actividad_fisica_modreadamente_activa, $actividad_fisica_ligeramente_activa,$actividad_fisica_sedentario){
            $testUsuarioDieta->setUuid(Uuid::uuid4()->toString());
            $testUsuarioDieta->setAltura($this->faker->randomFloat(null,1.40,2.10));
            $testUsuarioDieta->setPeso($this->faker->randomFloat(null,40,110));
            $testUsuarioDieta->setGenero($this->faker->randomElement(['HOMBRE','MUJER']));
            $testUsuarioDieta->setEdad($this->faker->numberBetween(16,80));
            $testUsuarioDieta->setEstadoFisico($this->faker->randomElement(self::ESTADO_ACTUAL));
            $testUsuarioDieta->setEstadoFisicoObjetivo($this->faker->randomElement(self::OBJETIVO_METABOLICO));
            $testUsuarioDieta->setActividadFisica($this->faker->randomElement([$actividad_fisica_hiperactivas,$actividad_fisica_muy_activas,$actividad_fisica_modreadamente_activa, $actividad_fisica_ligeramente_activa,$actividad_fisica_sedentario]));
            $testUsuarioDieta->setUser($this->getReference(self::USER.$count));

        });

        #Intensidad
        $intensidad_muy_alta = new IntensidadRutina();
        $intensidad_muy_alta->setUuid(Uuid::uuid4()->toString());
        $intensidad_muy_alta->setNombre("Muy Alta");
        $intensidad_muy_alta->setDescripcion("Intensidad de entrenamiento alto");
        $manager->persist($intensidad_muy_alta);


        $intensidad_alta = new IntensidadRutina();
        $intensidad_alta->setUuid(Uuid::uuid4()->toString());
        $intensidad_alta->setNombre("Alta");
        $intensidad_alta->setDescripcion("Intensidad de entrenamiento alto");
        $manager->persist($intensidad_alta);

        $intensidad_normal = new IntensidadRutina();
        $intensidad_normal->setUuid(Uuid::uuid4()->toString());
        $intensidad_normal->setNombre("Normal");
        $intensidad_normal->setDescripcion('Intensidad de entrenamiento medio');
        $manager->persist($intensidad_normal);

        $intensidad_baja = new IntensidadRutina();
        $intensidad_baja->setUuid(Uuid::uuid4()->toString());
        $intensidad_baja->setNombre("Normal");
        $intensidad_baja->setDescripcion("Intensidad de entrenamiento Normal");
        $manager->persist($intensidad_baja);


        $intensidad_baja = new IntensidadRutina();
        $intensidad_baja->setUuid(Uuid::uuid4()->toString());
        $intensidad_baja->setNombre("Baja");
        $intensidad_baja->setDescripcion("Intensidad de entrenamiento baja");
        $manager->persist($intensidad_baja);

        $intensidad_muy_baja = new IntensidadRutina();
        $intensidad_muy_baja->setUuid(Uuid::uuid4()->toString());
        $intensidad_muy_baja->setNombre("Muy Baja");
        $intensidad_muy_baja->setDescripcion("Intensidad de entrenamiento muy baja");
        $manager->persist($intensidad_muy_baja);


        $manager->flush();
    }

}
