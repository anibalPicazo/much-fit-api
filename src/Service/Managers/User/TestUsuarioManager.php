<?php


namespace App\Service\Managers\User;



use App\DTO\TestUsuario\TestUsuarioDTO;
use App\Entity\TestUsuario;
use App\Service\Managers\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;
use phpDocumentor\Reflection\Types\Integer;

class TestUsuarioManager extends AbstractManager
{

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(TestUsuario::class);
    }
    public function createTestUsuario(TestUsuarioDTO $DTO){

        $user = $DTO->getUser();
        $entity = new TestUsuario();
        $entity->setUser($user);
        $entity->setPeso($DTO->getPeso());
        $entity->setAltura($DTO->getAltura());
        $entity->setGenero($DTO->getGenero());
        $entity->setAdherenciaDeporte($DTO->getAdherenciaDeporte());
        $entity->setAdherenciaDieta($DTO->getAdherenciaDieta());
        $entity->setFrecuenciaEntrenamiento($this->decisionFrecuenciaEntrenamiento($DTO->getDiasEntrenamiento()));
        $entity->setCeliaco($DTO->getCeliaco());
        $entity->setDiabetico($DTO->getDiabetico());

        


    }
    public function decisionFrecuenciaEntrenamiento(array $dias){
        /** @var array $cantidad */
        $cantidad = count($dias) ;
        switch ($cantidad){
            case 1:
                $frecuencia="muy baja";
                break;
            case 2:
                $frecuencia="baja";
                break;
            case 3:
                $frecuencia="Media";
                break;
            case 4 or 5:
                $frecuencia="Alta";
                break;
            default:
                $frecuencia="nula";

        }
        return $frecuencia;
    }

}
