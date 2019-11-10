<?php


namespace App\Controller\Dieta;

use App\DTO\Rutina\AsignarRutinaDTO;
use App\DTO\Rutina\DiaCreateDTO;
use App\DTO\Rutina\DiaEjercicioCreateDTO;
use App\DTO\Rutina\RutinaCreateDTO;
use App\Entity\Role;
use App\Entity\Rutina;
use App\Service\Managers\Dieta\DietaManager;
use App\Service\Managers\Rutina\RutinaManager;
use App\Validator\DTOValidator;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Swagger\Annotations as SWG;



/**
 * Class RutinaController
 * @package App\Controller\Rutina
 * @Route("dietas")
 */
class DietaController extends AbstractController
{
    /**
     * @var DietaManager
     */
    private $manager;

    public function __construct(DietaManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("",methods={"GET"})
     * @View(serializerGroups={"list", "edit"})
     *
     */
    public function list(){
        return $this->manager->getList();
    }


}