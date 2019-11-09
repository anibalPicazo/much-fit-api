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


        $this->ruler();

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

    public function ruler(): void
    {
        $experiencia = 'media';
        $frecuencia = 'frmedia';
        $estadofisico = 'malo';
        //Initialise CLIPS environment and variables.
        ini_set('max_execution_time', 0);
        $arrCtx = array(); // This is the context, in which CLIPS runs.
        clips_init($arrCtx);
        ob_start(); // Turn on output buffering to capture CLIPS command outputs.
// Comment out above command, if you need debug output.

       // clips_exec('(clear)', false);
       // clips_exec('(reset)', false);
       // clips_exec('(defrule usuario  (usuario-experiencia MEDIA) => (assert (rutina-is ACLIMATACION)) )', false);
       // clips_exec('(assert (usuario-experiencia MEDIA))', false);
       // clips_exec('(run)', false);
       // ob_end_clean(); //Clear output buffer and cease buffering.
       // $arrFacts = array();
       // clips_query_facts($arrFacts, 'rutina-is');


        clips_exec('(clear)', false);
        clips_exec('(reset)', false);
        clips_exec('(defrule r1 (experiencia media)(estado-fisico malo) => (assert (rutina aclimatacion)) )', false);
        clips_exec('(assert (experiencia '.$experiencia.' ))', false);
        clips_exec('(assert (estado-fisico '.$estadofisico.'))', false);
        clips_exec('(run)', false);
        ob_end_clean(); //Clear output buffer and cease buffering.
        $arrFacts = array();
        clips_query_facts($arrFacts, 'rutina');
        //var_dump($arrFacts);

        dump($arrFacts[0]);
        die();



    }

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(TestUsuario::class);
    }


}
