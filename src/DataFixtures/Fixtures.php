<?php

namespace App\DataFixtures;

use App\Entity\ActividadFisica;
use App\Entity\Alimentos;
use App\Entity\ConsecuenteNutricion;
use App\Entity\ConsecuenteRutina;
use App\Entity\Dia;
use App\Entity\DiaDieta;
use App\Entity\DiaEjercicio;
use App\Entity\Dieta;
use App\Entity\Ejercicios;
use App\Entity\IntensidadRutina;
use App\Entity\Meal;
use App\Entity\PremisasDieta;
use App\Entity\PremisasRutina;
use App\Entity\Role;
use App\Entity\Rutina;
use App\Entity\TestUsuario;
use App\Entity\TestUsuarioDieta;
use App\Entity\TipoFisico;
use App\Entity\Unidad;
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
    const DIAS_EJERCICIO = 150;
    const UNIDADES_MEDIDAS =7;
    const ESTADO_FISICO = ['MALO','NORMAL','BUENO'];
    const EXPERIENCIA = ['ALTA','MUY ALTA','INTERMEDIO','BAJO'];
    const FRECUENCIA = ['< 2','2 - 3','> 3'];
    const ESTADO_ACTUAL = ['DEFINIDO','SOBREPESO','DELGADO','LIGERAMENTE SOBREPESO','EXTREMA DELGADEZ','MUSCULOSO'];
    const TIPO_DIETA = ['hipocalorica','mantenimiento','calorica-hidratos'];
    const OBJETIVO_METABOLICO = ['DEFINIDO','MUSCULOSO','NORMAL'];
    const INTENSIDAD_ENTRENAMIENTO =["MUY ALTA","ALTA","MEDIA","BAJA","MUY BAJA"];
    const TIPO_RUTINA = ["aclimatacion","principiante","intermedia","avanzada","intermedia-ganancia-fuerza","intermedia-hipertrofia","avanzada-hipertrofia","avanzada-ganancia-fuerza"];
    const DIAS =["Dia A","Dia B","Dia C"];
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

        #TEST USUARIO
        $this->createMany(TestUsuario::class,self::USUARIOS,function(TestUsuario $testUsuario, $count){
           $testUsuario->setUuid(Uuid::uuid4()->toString());
           $testUsuario->setExperienciaDeporte($this->faker->randomElement(self::EXPERIENCIA));
           $testUsuario->setFormaFisica($this->faker->randomElement(self::ESTADO_FISICO));
           $testUsuario->setFrecuenciaEntrenamiento($this->faker->randomElement(self::FRECUENCIA));
           $testUsuario->setUser($this->getReference(self::USER.$count));
        });

        #RUTINAS
        $this->createMany(Rutina::class,sizeof(Self::TIPO_RUTINA),function(Rutina $rutina, $count){
            $rutina->setUuid(Uuid::uuid4()->toString());
            $rutina->setDesgasteCalorico($this->faker->randomFloat(2,400,800));
            $rutina->setDificultadUsuario($this->faker->randomElement(['facil','medio','dificil']));
            $rutina->setFrecuencia($this->faker->numberBetween(1,5));
            $rutina->setVolumen($this->faker->numberBetween(1,3));
            $rutina->setNombre(self::TIPO_RUTINA[$count]);
            $rutina->setDuracion($this->faker->randomFloat(2,60,120));
            $rutina->setObjetivo($this->faker->randomElement(['Hipertrofia','Ganancia Muscular']));
            $this->addReference('Rutina'.$count,$rutina);

        });

        $this->createMany(Dia::class,sizeof(Self::DIAS)*12,function(Dia $dia, $count){
            $dia->setUuid(Uuid::uuid4()->toString());
            $dia->setNombre($this->faker->randomElement(Self::DIAS));
            $dia->setRutina($this->getReference('Rutina' .$this->faker->numberBetween(0,sizeof(self::TIPO_RUTINA)-1)));
            $this->addReference( 'Dia'.$count,$dia);
        });


        $this->createMany(DiaEjercicio::class,self::DIAS_EJERCICIO ,function(DiaEjercicio $dia_ejercicio, $count){
            $dia_ejercicio->setUuid(Uuid::uuid4()->toString());
            $dia_ejercicio->setSeries($this->faker->numberBetween(1,4) .' Series');
            $dia_ejercicio->setIntensidad($this->faker->numberBetween(1,3));
            $dia_ejercicio->setDescanso($this->faker->numberBetween(30,60));
            $dia_ejercicio->setRepeticiones($this->faker->numberBetween(6,12));
            $dia_ejercicio->setEjercicio($this->faker->randomElement($this->manager->getRepository(Ejercicios::class)->findAll()));
            $dia_ejercicio->setDia($this->getReference('Dia'.$this->faker->numberBetween(0,(sizeof((self::DIAS))*12)-1)));
        });





        #UNIDAD MEDIDA
        $unidades = new Unidad();
        $unidades->setUuid(Uuid::uuid4());
        $unidades->setDescripcion("Unidades");
        $unidades->setIniciales("Uds");
        $this->addReference('Unidad0',$unidades);
        $manager->persist($unidades);

        $kilos = new Unidad();
        $kilos->setUuid(Uuid::uuid4());
        $kilos->setDescripcion("Kilos");
        $kilos->setIniciales("kg");
        $this->addReference('Unidad1',$kilos);
        $manager->persist($kilos);


        $gramos = new Unidad();
        $gramos->setUuid(Uuid::uuid4());
        $gramos->setDescripcion("Gramos");
        $gramos->setIniciales("Gr");
        $manager->persist($gramos);
        $this->addReference('Unidad2',$gramos);



        $onzas = new Unidad();
        $onzas->setUuid(Uuid::uuid4());
        $onzas->setDescripcion("Onzas");
        $onzas->setIniciales("Oz");
        $this->addReference('Unidad3',$onzas);
        $manager->persist($onzas);



        $tsp= new Unidad();
        $tsp->setUuid(Uuid::uuid4());
        $tsp->setDescripcion("Cucharadita");
        $tsp->setIniciales("Tsp");
        $manager->persist($tsp);
        $this->addReference('Unidad4',$tsp);


        $cucharada = new Unidad();
        $cucharada->setUuid(Uuid::uuid4());
        $cucharada->setDescripcion("Cucharada");
        $cucharada->setIniciales("Tbsp");
        $manager->persist($cucharada);
        $this->addReference('Unidad5',$cucharada);


        $taza = new Unidad();
        $taza->setUuid(Uuid::uuid4());
        $taza->setDescripcion("Tazas");
        $taza->setIniciales("Cups");
        $this->addReference('Unidad6',$taza);

        $manager->persist($taza);

        #DIETAS
        $this->createMany(Dieta::class,sizeof(Self::TIPO_DIETA),function(Dieta $dieta, $count){
            $dieta->setUuid(Uuid::uuid4()->toString());
            $dieta->setDescripcion(self::TIPO_DIETA[$count]);
            $dieta->setAporteCaloricoDiario($this->faker->randomFloat(2,900,2100));
            $dieta->setNivelCarbohidratos($this->faker->randomElement(['Alto','Medio','Bajo']));
            $dieta->setNivelGrasas($this->faker->randomElement(['Alto','Medio','Bajo']));
            $dieta->setProteina($this->faker->randomElement(['Alto','Medio','Bajo']));
            $this->addReference('Dieta'.$count,$dieta);

        });
        $this->createMany(DiaDieta::class,sizeof(Self::DIAS),function(DiaDieta $dia_dieta, $count){
            $dia_dieta->setUuid(Uuid::uuid4()->toString());
            $dia_dieta->setDescripcion(self::DIAS[$count]);
            $dia_dieta->setDieta($this->getReference('Dieta'.$this->faker->numberBetween(0,(sizeof(self::DIAS))-1)));
            $this->addReference('Dia_dieta'.$count,$dia_dieta);

        });
        $this->createMany(Meal::class,sizeof(Self::DIAS)*50,function(Meal $meal, $count){
            $meal->setUuid(Uuid::uuid4()->toString());
            $meal->setTipo($this->faker->randomElement(['Desayuno','Comida','Merienda','Cena']));
            $meal->setAlimento($this->faker->randomElement($this->manager->getRepository(Alimentos::class)->findAll()));
            $meal->setUnidad($this->getReference('Unidad'.$this->faker->numberBetween(0,self::UNIDADES_MEDIDAS-1)));
            $meal->setCantidad($this->faker->randomFloat(2,20,500));
            $meal->setDiaDieta($this->getReference('Dia_dieta' . $this->faker->numberBetween(0,(sizeof(self::DIAS))-1)));

        });


        $manager->flush();

    }

}
