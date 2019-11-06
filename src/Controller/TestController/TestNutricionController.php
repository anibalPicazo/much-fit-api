<?php



namespace App\Controller\TestController;
use App\DTO\TestUsuario\TestNutricionalCreateDTO;
use App\Entity\Role;
use App\Entity\TestUsuarioDieta;
use App\Service\Managers\TestManager\TestEntrenamientoManager;
use App\Service\Managers\TestManager\TestNutricionManager;
use App\Validator\DTOValidator;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * @Route("test_nutricion")
 * Class TestEntrenamientoController
 * @package App\Controller\TestController
 */
class TestNutricionController extends AbstractController
{
    /**
     * @var DTOValidator
     */
    private $DTOValidator;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    /**
     * @var TestEntrenamientoManager
     */
    private $manager;

    /**
     * TestEntrenamientoController constructor.
     * @param DTOValidator $DTOValidator
     * @param EventDispatcherInterface $dispatcher
     * @param TestNutricionManager $manager
     */
    public function __construct(DTOValidator $DTOValidator, EventDispatcherInterface $dispatcher, TestNutricionManager $manager)
    {
        $this->DTOValidator = $DTOValidator;
        $this->dispatcher = $dispatcher;
        $this->manager = $manager;
    }

    /**
     * @Rest\Route("", methods={"POST"})
     * @param TestNutricionalCreateDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @View(serializerGroups={"list"})
     * @throws ExceptionInterface
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     * @SWG\Tag(name="Test Entrenamiento")
     * @SWG\Response(
     *     response=200,
     *     description="Crear Test de Nutricion"
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="DTO",
     *     @SWG\Schema(
     *         type="object",
     *         ref=@Model(type=TestNutricionalCreateDTO::class)
     *     )
     * )
     * @Security(name="Bearer")
     */
    public function createTest(TestNutricionalCreateDTO $DTO, Request $request)
    {
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
     * @Rest\Route("", methods={"GET"})
     * @return JsonResponse
     * @View(serializerGroups={"list"})
     */
    public function list(){

        return $this->manager->getList(['user'=>$this->getUser()]);
    }

    /**
     * @Rest\Route("/{uuid}", methods={"GET"})
     * @ParamConverter("test", options={"mapping": {"uuid": "uuid"}})
     * @param TestUsuarioDieta $test
     * @return TestUsuarioDieta
     * @View(serializerGroups={"list"})
     */
    public function getOne(TestUsuarioDieta $test){

        return $test;
    }


}
