<?php


namespace App\Controller\Entrenamiento;


use App\DTO\Entrenamiento\EntrenamientoCreateDTO;
use App\DTO\Entrenamiento\EntrenamientoLineaCreateDTO;
use App\Entity\Role;
use App\Service\Managers\Entrenamiento\EntrenamientoManager;
use App\Validator\DTOValidator;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use FOS\RestBundle\Controller\Annotations\View;



/**
 * Class EntrenamientoController
 * @package App\Controller\Entrenamiento
 * @Route("entrenamientos")
 */
class EntrenamientoController extends AbstractController
{
    /**
     * @var EntrenamientoManager
     */
    protected $manager;
    /**
     * @var DTOValidator
     */
    protected $DTOValidator;

    /**
     * EntrenamientoController constructor.
     * @param EntrenamientoManager $manager
     * @param DTOValidator $DTOValidator
     */
    public function __construct(EntrenamientoManager $manager, DTOValidator $DTOValidator)
    {
        $this->manager = $manager;
        $this->DTOValidator = $DTOValidator;
    }

    /**
     * @Route("",methods={"POST"})
     * @param EntrenamientoCreateDTO $DTO
     * @param Request $request
     * @View(serializerGroups={"list", "edit"})
     * @return JsonResponse
     * @throws ExceptionInterface
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     * @SWG\Tag(name="Entrenamiento")
     * @SWG\Response(
     *     response=200,
     *     description="Crear entrenamientos"
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="DTO",
     *     @SWG\Schema(
     *         type="object",
     *         ref=@Model(type=EntrenamientoCreateDTO::class)
     *     )
     * )
     * @Security(name="Bearer")
     */
    public function create(EntrenamientoCreateDTO $DTO, Request $request){
        //SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_ROOT);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }
        //COMAND
        $this->manager->create($DTO);

        //RESPONSE
        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    /**
     * @param EntrenamientoLineaCreateDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function addLine(EntrenamientoLineaCreateDTO $DTO, Request $request){
        //SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_ROOT);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }
        //COMAND
        $this->manager->addLinea($DTO);
        //RESPONSE
        return new JsonResponse(null, Response::HTTP_CREATED);

    }


}
