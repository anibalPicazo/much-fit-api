<?php

namespace App\DataFixtures;

use App\Entity\ActividadFisica;
use App\Entity\ConsecuenteNutricion;
use App\Entity\ConsecuenteRutina;
use App\Entity\Dia;
use App\Entity\DiaEjercicio;
use App\Entity\IntensidadRutina;
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
    const DIAS_EJERCICIO = 50;
    const ESTADO_FISICO = ['MALO','NORMAL','BUENO'];
    const EXPERIENCIA = ['ALTA','MUY ALTA','INTERMEDIO','BAJO'];
    const FRECUENCIA = ['< 2','2 - 3','> 3'];
    const ESTADO_ACTUAL = ['DEFINIDO','SOBREPESO','DELGADO','LIGERAMENTE SOBREPESO','EXTREMA DELGADEZ','MUSCULOSO'];
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
            $dia_ejercicio->setSeries('Serie '.$this->faker->numberBetween(1,4));
            $dia_ejercicio->setIntensidad($this->faker->numberBetween(1,3));
            $dia_ejercicio->setDescanso($this->faker->numberBetween(30,60));
            $dia_ejercicio->setEjercicio();

        });





        #UNIDAD MEDIDA
        $unidades = new Unidad();
        $unidades->setUuid(Uuid::uuid4());
        $unidades->setDescripcion("Unidades");
        $unidades->setIniciales("Uds");
        $manager->persist($unidades);

        $kilos = new Unidad();
        $kilos->setUuid(Uuid::uuid4());
        $kilos->setDescripcion("Kilos");
        $kilos->setIniciales("kg");
        $manager->persist($kilos);


        $gramos = new Unidad();
        $gramos->setUuid(Uuid::uuid4());
        $gramos->setDescripcion("Gramos");
        $gramos->setIniciales("Gr");
        $manager->persist($gramos);


        $onzas = new Unidad();
        $onzas->setUuid(Uuid::uuid4());
        $onzas->setDescripcion("Onzas");
        $onzas->setIniciales("Oz");
        $manager->persist($onzas);


        $tsp= new Unidad();
        $tsp->setUuid(Uuid::uuid4());
        $tsp->setDescripcion("Cucharadita");
        $tsp->setIniciales("Tsp");
        $manager->persist($tsp);

        $cucharada = new Unidad();
        $cucharada->setUuid(Uuid::uuid4());
        $cucharada->setDescripcion("Cucharada");
        $cucharada->setIniciales("Tbsp");
        $manager->persist($cucharada);

        $taza = new Unidad();
        $taza->setUuid(Uuid::uuid4());
        $taza->setDescripcion("Tazas");
        $taza->setIniciales("Cups");
        $manager->persist($taza);


        // PREMISAS DE NUTRICION //

        $pre_nutri_definicion = new PremisasDieta();
        $pre_nutri_definicion->setUuid(Uuid::uuid4()->toString());
        $pre_nutri_definicion->setHint('definicion');
        $pre_nutri_definicion->setRuleCode('OBDEF');
        $manager->persist($pre_nutri_definicion);


        $pre_nutri_perder_grasa = new PremisasDieta();
        $pre_nutri_perder_grasa->setUuid(Uuid::uuid4()->toString());
        $pre_nutri_perder_grasa->setHint('perderGrasa');
        $pre_nutri_perder_grasa->setRuleCode('OBMAN');
        $manager->persist($pre_nutri_perder_grasa);

        $pre_nutri_vol = new PremisasDieta();
        $pre_nutri_vol->setUuid(Uuid::uuid4()->toString());
        $pre_nutri_vol->setHint('volumen');
        $pre_nutri_vol->setRuleCode('OBVOL');
        $manager->persist($pre_nutri_vol);

        $pre_nutri_novato = new PremisasDieta();
        $pre_nutri_novato->setUuid(Uuid::uuid4()->toString());
        $pre_nutri_novato->setHint('baja');
        $pre_nutri_novato->setRuleCode('EXNO');
        $manager->persist($pre_nutri_novato);

        $pre_nutri_intermedio = new PremisasDieta();
        $pre_nutri_intermedio->setUuid(Uuid::uuid4()->toString());
        $pre_nutri_intermedio->setHint('media');
        $pre_nutri_intermedio->setRuleCode('EXINTER');
        $manager->persist($pre_nutri_intermedio);

        $pre_nutri_avanzado = new PremisasDieta();
        $pre_nutri_avanzado->setUuid(Uuid::uuid4()->toString());
        $pre_nutri_avanzado->setHint('alta');
        $pre_nutri_avanzado->setRuleCode('EXPRO');
        $manager->persist($pre_nutri_avanzado);


        $pre_nutri_normo = new PremisasDieta();
        $pre_nutri_normo->setUuid(Uuid::uuid4()->toString());
        $pre_nutri_normo->setHint('normopeso');
        $pre_nutri_normo->setRuleCode('ESNP');
        $manager->persist($pre_nutri_normo);

        $pre_nutri_definido = new PremisasDieta();
        $pre_nutri_definido->setUuid(Uuid::uuid4()->toString());
        $pre_nutri_definido->setHint('definido');
        $pre_nutri_definido->setRuleCode('ESDF');
        $manager->persist($pre_nutri_definido);

        $pre_nutri_sobrepeso = new PremisasDieta();
        $pre_nutri_sobrepeso->setUuid(Uuid::uuid4()->toString());
        $pre_nutri_sobrepeso->setHint('sobrepeso');
        $pre_nutri_sobrepeso->setRuleCode('ESSP');
        $manager->persist($pre_nutri_sobrepeso);


        //PREMISAS DE ENTRENAMIENTO //


        $pre_rutina_fre_baja = new PremisasRutina();
        $pre_rutina_fre_baja->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_fre_baja->setHint('Más de un año');
        $pre_rutina_fre_baja->setRuleCode('EXMAL');
        $manager->persist($pre_rutina_fre_baja);

        $pre_rutina_exp_alta = new PremisasRutina();
        $pre_rutina_exp_alta->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_exp_alta->setHint('De ocho meses');
        $pre_rutina_exp_alta->setRuleCode('EXAL');
        $manager->persist($pre_rutina_exp_alta);

        $pre_rutina_exp_media = new PremisasRutina();
        $pre_rutina_exp_media->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_exp_media->setHint('De dos a ocho meses');
        $pre_rutina_exp_media->setRuleCode('EXME');
        $manager->persist($pre_rutina_exp_media);

        $pre_rutina_exp_baja = new PremisasRutina();
        $pre_rutina_exp_baja->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_exp_baja->setHint('De cero meses a dos meses');
        $pre_rutina_exp_baja->setRuleCode('EXBA');
        $manager->persist($pre_rutina_exp_baja);

        $pre_rutina_fre_baja = new PremisasRutina();
        $pre_rutina_fre_baja->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_fre_baja->setHint('Menos de dos días');
        $pre_rutina_fre_baja->setRuleCode('FRBA');
        $manager->persist($pre_rutina_fre_baja);


        $pre_rutina_fre_media = new PremisasRutina();
        $pre_rutina_fre_media->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_fre_media->setHint('Entre 2 y 3 días');
        $pre_rutina_fre_media->setRuleCode('FRME');
        $manager->persist($pre_rutina_fre_media);

        $pre_rutina_fre_alta= new PremisasRutina();
        $pre_rutina_fre_alta->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_fre_alta->setHint('Más de 3 días');
        $pre_rutina_fre_alta->setRuleCode('FRAL');
        $manager->persist($pre_rutina_fre_alta);


        //ESTADO FISICO PERCIBIDO

        $pre_rutina_estado_fis_malo = new PremisasRutina();
        $pre_rutina_estado_fis_malo->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_estado_fis_malo->setHint('Malo');
        $pre_rutina_estado_fis_malo->setRuleCode('EFMAL');
        $manager->persist($pre_rutina_estado_fis_malo);

        $pre_rutina_estado_fis_medio = new PremisasRutina();
        $pre_rutina_estado_fis_medio->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_estado_fis_medio->setHint('Normal');
        $pre_rutina_estado_fis_medio->setRuleCode('EFNR');
        $manager->persist($pre_rutina_estado_fis_medio);

        $pre_rutina_estado_fis_bueno = new PremisasRutina();
        $pre_rutina_estado_fis_bueno->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_estado_fis_bueno->setHint('Bueno');
        $pre_rutina_estado_fis_bueno->setRuleCode('EFBU');
        $manager->persist($pre_rutina_estado_fis_bueno);
        //OBJETIVOS

        $pre_rutina_objetivo_hiper = new PremisasRutina();
        $pre_rutina_objetivo_hiper->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_objetivo_hiper->setHint('hipertrofia');
        $pre_rutina_objetivo_hiper->setRuleCode('OBHI');
        $manager->persist($pre_rutina_objetivo_hiper);

        $pre_rutina_objetivo_ganancia = new PremisasRutina();
        $pre_rutina_objetivo_ganancia->setUuid(Uuid::uuid4()->toString());
        $pre_rutina_objetivo_ganancia->setHint('Bueno');
        $pre_rutina_objetivo_ganancia->setRuleCode('OBFU');
        $manager->persist($pre_rutina_objetivo_ganancia);

        //CONSECUENTES RUTINA

        $consecuente_rutina_acl = new ConsecuenteRutina();
        $consecuente_rutina_acl->setUuid(Uuid::uuid4()->toString());
        $consecuente_rutina_acl->setHint('Rutina Aclimatacion');
        $consecuente_rutina_acl->setRuleCode('RUACL');
        $manager->persist($consecuente_rutina_acl);

        $consecuente_rutina_princ = new ConsecuenteRutina();
        $consecuente_rutina_princ->setUuid(Uuid::uuid4()->toString());
        $consecuente_rutina_princ->setHint('Rutina Principiante');
        $consecuente_rutina_princ->setRuleCode('RUPRIN');
        $manager->persist($consecuente_rutina_princ);

        $consecuente_rutina_inter = new ConsecuenteRutina();
        $consecuente_rutina_inter->setUuid(Uuid::uuid4()->toString());
        $consecuente_rutina_inter->setHint('Rutina Intermedia');
        $consecuente_rutina_inter->setRuleCode('RUINT');
        $manager->persist($consecuente_rutina_inter);

        $consecuente_rutina_inter_hiper = new ConsecuenteRutina();
        $consecuente_rutina_inter_hiper->setUuid(Uuid::uuid4()->toString());
        $consecuente_rutina_inter_hiper->setHint('Rutina Intermedia de hipertrofia');
        $consecuente_rutina_inter_hiper->setRuleCode('RUINTHF');
        $manager->persist($consecuente_rutina_inter_hiper);

        $consecuente_rutina_inter_fuerza = new ConsecuenteRutina();
        $consecuente_rutina_inter_fuerza->setUuid(Uuid::uuid4()->toString());
        $consecuente_rutina_inter_fuerza->setHint('Rutina Intermedia de ganancia de fuerza');
        $consecuente_rutina_inter_fuerza->setRuleCode('RUINTGF');
        $manager->persist($consecuente_rutina_inter_fuerza);

        $consecuente_rutina_avanzada = new ConsecuenteRutina();
        $consecuente_rutina_avanzada->setUuid(Uuid::uuid4()->toString());
        $consecuente_rutina_avanzada->setHint('Rutina avanzada');
        $consecuente_rutina_avanzada->setRuleCode('RUAVN');
        $manager->persist($consecuente_rutina_avanzada);

        $consecuente_rutina_avanzada_hipertrofia = new ConsecuenteRutina();
        $consecuente_rutina_avanzada_hipertrofia->setUuid(Uuid::uuid4()->toString());
        $consecuente_rutina_avanzada_hipertrofia->setHint('Rutina avanzada de hipertrofia');
        $consecuente_rutina_avanzada_hipertrofia->setRuleCode('RUAVNHF');
        $manager->persist($consecuente_rutina_avanzada_hipertrofia);

        $consecuente_rutina_avanzada_fuerza = new ConsecuenteRutina();
        $consecuente_rutina_avanzada_fuerza->setUuid(Uuid::uuid4()->toString());
        $consecuente_rutina_avanzada_fuerza->setHint('Rutina avanzada de ganancia de fuerza');
        $consecuente_rutina_avanzada_fuerza->setRuleCode('RUAVNGF');
        $manager->persist($consecuente_rutina_avanzada_fuerza);

        //CONSECUENTES DIETA

        $consecuente_dieta_cal = new ConsecuenteNutricion();
        $consecuente_dieta_cal->setUuid(Uuid::uuid4()->toString());
        $consecuente_dieta_cal->setHint('Dieta calórica y alta en hidratos');
        $consecuente_dieta_cal->setRuleCode('DIECAHI');
        $manager->persist($consecuente_dieta_cal);

        $consecuente_dieta_med = new ConsecuenteNutricion();
        $consecuente_dieta_med->setUuid(Uuid::uuid4()->toString());
        $consecuente_dieta_med->setHint('Dieta de un impacto medio calórico y macros medios');
        $consecuente_dieta_med->setRuleCode('DIEME');
        $manager->persist($consecuente_dieta_med);

        $consecuente_dieta_hipo = new ConsecuenteNutricion();
        $consecuente_dieta_hipo->setUuid(Uuid::uuid4()->toString());
        $consecuente_dieta_hipo->setHint('Dieta alta Hipocalórica');
        $consecuente_dieta_hipo->setRuleCode('DIEHIPOAL');
        $manager->persist($consecuente_dieta_hipo);

        $consecuente_dieta_hipo_med = new ConsecuenteNutricion();
        $consecuente_dieta_hipo_med->setUuid(Uuid::uuid4()->toString());
        $consecuente_dieta_hipo_med->setHint('Dieta alta Hipocalórica media');
        $consecuente_dieta_hipo_med->setRuleCode('DIEHP');
        $manager->persist($consecuente_dieta_hipo_med);

        $consecuente_dieta_CH = new ConsecuenteNutricion();
        $consecuente_dieta_CH->setUuid(Uuid::uuid4()->toString());
        $consecuente_dieta_CH->setHint('Dieta Chris Heria');
        $consecuente_dieta_CH->setRuleCode('DIECH');
        $manager->persist($consecuente_dieta_CH);


        $manager->flush();

    }

}
