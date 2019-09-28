<?php


namespace App\Controller\Rutina;


use App\DTO\Rutina\DiaCreateDTO;
use App\DTO\Rutina\DiaEjercicioCreateDTO;
use App\DTO\Rutina\RutinaCreateDTO;
use App\Entity\Role;
use App\Entity\Rutina;
use App\Service\Managers\Rutina\RutinaManager;
use App\Validator\DTOValidator;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Swagger\Annotations as SWG;


/**
 * Class RutinaController
 * @package App\Controller\Rutina
 * @Route("rutinas")
 */
class RutinaController extends AbstractController
{
    /**
     * @var RutinaManager
     */
    protected $manager;
    /**
     * @var DTOValidator
     */
    protected $DTOValidator;

    public function __construct(RutinaManager $manager, DTOValidator $DTOValidator)
    {
        $this->manager = $manager;
        $this->DTOValidator = $DTOValidator;
    }

    /**
     * @Route("",methods={"POST"})
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     * @param RutinaCreateDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     * @SWG\Tag(name="Rutinas")
     * @SWG\Response(
     *     response=200,
     *     description="Crear Rutina"
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="DTO",
     *     @SWG\Schema(
     *         type="object",
     *         ref=@Model(type=RutinaCreateDTO::class)
     *     )
     * )
     * @Security(name="Bearer")
     */
    public function createRutina(RutinaCreateDTO $DTO,Request $request){
        //SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_ROOT);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }
        //COMAND
        $this->manager->createRutina($DTO);
        //RESPONSE
        return new JsonResponse(null, Response::HTTP_CREATED);

    }

    /**
     * @Route("/{uuid_rutina}/dias", methods={"POST"})
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     * @ParamConverter("rutina", options={"mapping": {"uuid_rutina": "uuid"}})
     * @param DiaCreateDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     * @SWG\Tag(name="Rutinas")
     * @SWG\Response(
     *     response=200,
     *     description="Crear dia rutina, una rutina va tener varios dias, y estos dias son los que tendra
     *                   varios diasEjercicio, donde tendremos por ejemplo que el Lunes(Dia) tendra Press
     *                    Banca , X repeticiones, a tanta intesidad (DiaEjercicio)"
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="DTO",
     *     @SWG\Schema(
     *         type="object",
     *         ref=@Model(type=DiaCreateDTO::class)
     *     )
     * )
     * @Security(name="Bearer")
     */
    public function createDia(DiaCreateDTO $DTO, Request $request,Rutina $rutina){
        //SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_ROOT);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }
        //COMAND
        $this->manager->createDia($DTO);
        //RESPONSE
        return new JsonResponse(null, Response::HTTP_CREATED);

    }

    /**
     * @Route("/{uuid_rutina}/dias/{uuid_dia}")
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     * @ParamConverter("rutina", options={"mapping": {"uuid_rutina": "uuid"}})
     * @ParamConverter("dita", options={"mapping": {"uuid_dia": "uuid"}})
     * @param DiaEjercicioCreateDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function createDiaEjercicio(DiaEjercicioCreateDTO $DTO, Request $request){
        //SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_ROOT);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }
        //COMAND
        $this->manager->createDiaEjercico($DTO);
        //RESPONSE
        return new JsonResponse(null, Response::HTTP_CREATED);

    }

}
