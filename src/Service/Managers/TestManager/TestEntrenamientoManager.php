<?php


namespace App\Service\Managers\TestManager;


use App\DTO\TestUsuario\TestUsuarioEntrenamientoCreateDTO;
use App\Entity\PremisasRutina;
use App\Entity\TestUsuario;
use App\Service\Managers\AbstractManager;
use App\Service\Uploads\AbstractUploadStorage;
use Doctrine\Common\Persistence\ObjectRepository;

class TestEntrenamientoManager extends AbstractManager{

    public function create(TestUsuarioEntrenamientoCreateDTO $DTO)
    {
        $test = new TestUsuario();
        $test->setUuid($DTO->getUuid());
        $test->setUser($this->getCurrent());
        $test->setFormaFisica($DTO->getFormaFisica());
        $test->setExperienciaDeporte($DTO->getExperienciaDeporte());
        $test->setFrecuenciaEntrenamiento($DTO->getFrecuencia());
        $DTO->getObjetivo() ? $test->setObjetivo($DTO->getObjetivo()) : null;

      //  $rule_exp = $this->doctrine->getRepository(PremisasRutina::class)->findOneBy(['hint'=> $this->calcExperiencia($DTO)]);
       // $rule_frec = $this->doctrine->getRepository(PremisasRutina::class)->findOneBy(['hint'=>$this->calcFrecuencia($DTO)]);
       // $rule_ob = $this->doctrine->getRepository(PremisasRutina::class)->findOneBy(['hint' => $DTO->getObjetivo()]);
       // $rule_estadofiscio = $this->doctrine->getRepository(PremisasRutina::class)->findOneBy(['hint'=>$DTO->getFormaFisica()]);


        $this->ruler('media','' ,'malo');


        $this->save($test);
        return $test;
    }

    /**
     * @param TestUsuarioEntrenamientoCreateDTO $DTO
     * @return string
     */
    public function calcFrecuencia(TestUsuarioEntrenamientoCreateDTO $DTO)
    {
        switch ($DTO->getFrecuencia()) {
            case 'Menos de dos días';
                $frec = 'Bajo';
                break;
            case 'Entre 2 y 3 días':
                $frec = 'Medio';
                break;
            case 'Más de 3 días':
                $frec = 'Alto';
                break;

        }
        return $frec;
    }

    /**
     * @param TestUsuarioEntrenamientoCreateDTO $DTO
     * @return string
     */
    public function calcExperiencia(TestUsuarioEntrenamientoCreateDTO $DTO)
    {
        switch ($DTO->getExperienciaDeporte()) {
            case 'Más de un año':
                $exp = 'Muy alta';
                break;
            case 'De ocho meses a un año':
                $exp = 'Alta';
                break;
            case 'De dos a ocho meses':
                $exp = 'Media';
                break;
            case 'De cero a dos meses':
                $exp = 'Baja';
                break;
        }
        return $exp;
    }

    public function ruler($experiencia='',$frecuencia='',$estadofisico='',$objetivo='')
    {

        //Initialise CLIPS environment and variables.
        ini_set('max_execution_time', 0);
        $arrCtx = array(); // This is the context, in which CLIPS runs.
        clips_init($arrCtx);
        ob_start(); // Turn on output buffering to capture CLIPS command outputs.

        clips_exec('(clear)', false);
        clips_exec('(reset)', false);
        //REGLA 1:
        clips_exec('(defrule r1 (experiencia media)
                                (estado-fisico malo) => 
                                (assert (rutina aclimatacion)) )', false);
        //REGLA 2:
        clips_exec('(defrule r2 (experiencia baja) => 
                                (assert (rutina aclimatacion)) )', false);
        //REGLA 3:
        clips_exec('(defrule r3 (experiencia media)
                                (estado-fisico malo)
                                (frecuencia media) => 
                                (assert (rutina principiante)) )', false);
        //REGLA 4:
        clips_exec('(defrule r4 (experiencia media)
                                (estado-fisico normal)
                                (frecuencia media) => 
                                (assert (rutina intermedia)) )', false);
        //REGLA 5:
        clips_exec('(defrule r5 (experiencia media)
                                (estado-fisico bueno)
                                (frecuencia baja) => 
                                (assert (rutina intermedia)) )', false);
        //REGLA 6:
        clips_exec('(defrule r6 (rutina intermedia)
                                (objetivo hipertrofia) => 
                                (assert (rutina intermedia-hipertrofia)) )', false);
        //REGLA 7:
        clips_exec('(defrule r7 (rutina intermedia)
                                (objetivo ganancia-fuerza) => 
                                (assert (rutina intermedia-ganancia-fuerza)) )', false);
        //REGLA 8:
        clips_exec('(defrule r8 (experiencia media)
                                (estado-fisico bueno)
                                (frecuencia alta) => 
                                (assert (rutina avanzada)) )', false);
        //REGLA 9:
        clips_exec('(defrule r9 (experiencia alta)
                                (estado-fisico normal) => 
                                (assert (rutina avanzada)) )', false);
        //REGLA 10:
        clips_exec('(defrule r10 (rutina avanzada)
                                 (objetivo hipertrofia) => 
                                 (assert (rutina avanzada-hipertrofia)) )', false);
        //REGLA 11:
        clips_exec('(defrule r11 (rutina avanzada)
                                 (objetivo ganancia-fuerza) => 
                                 (assert (rutina avanzada-ganancia-fuerza)) )', false);
        //INSERCION DE LOS HECHOS
        $experiencia !== '' ? clips_exec('(assert (experiencia '.$experiencia.' ))', false) : null;
        $estadofisico !== '' ? clips_exec('(assert (estado-fisico '.$estadofisico.'))', false) : null;
        $frecuencia !== '' ? clips_exec('(assert (frecuencia '.$frecuencia.'))', false) : null;
        $objetivo !== '' ? clips_exec('(assert (objetivo '.$objetivo.'))', false) : null;

        //EJECUTAMOS LAS REGLAS
        clips_exec('(run)', false);
        ob_end_clean(); //Clear output buffer and cease buffering.
        $arrFacts = array();
        clips_query_facts($arrFacts, 'rutina');


        //CONSECUENTE
       return sizeof($arrFacts) <= 1 ?   $arrFacts[0][0] : $arrFacts[1][0];


    }

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(TestUsuario::class);
    }


}
