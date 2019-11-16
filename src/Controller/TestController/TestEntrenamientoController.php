<?php


namespace App\Controller\TestController;


use App\DTO\TestUsuario\TestUsuarioEntrenamientoCreateDTO;
use App\Entity\Role;
use App\Entity\TestUsuario;
use App\EventSubscriber\Event\DelegacionEvent;
use App\Service\Managers\TestManager\TestEntrenamientoManager;
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
 * @Route("test_entrenamientos")
 * Class TestEntrenamientoController
 * @package App\Controller\TestController
 */
class TestEntrenamientoController extends AbstractController
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
     * @param TestEntrenamientoManager $manager
     */
    public function __construct(DTOValidator $DTOValidator, EventDispatcherInterface $dispatcher, TestEntrenamientoManager $manager)
    {
        $this->DTOValidator = $DTOValidator;
        $this->dispatcher = $dispatcher;
        $this->manager = $manager;
    }

    /**
     * @Rest\Route("", methods={"POST"})
     * @param TestUsuarioEntrenamientoCreateDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     * @throws ExceptionInterface
     * @SWG\Tag(name="Test Entrenamiento")
     * @SWG\Response(
     *     response=200,
     *     description="Crear Test de Entrenamiento"
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="DTO",
     *     @SWG\Schema(
     *         type="object",
     *         ref=@Model(type=TestUsuarioEntrenamientoCreateDTO::class)
     *     )
     * )
     * @Security(name="Bearer")
     */
    public function createTest(TestUsuarioEntrenamientoCreateDTO $DTO, Request $request){
        //SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_USER);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }
        //COMAND
        $this->manager->create($DTO);
        //RESPONSE
        return new JsonResponse(null, Response::HTTP_CREATED);

        $this->dispatcher->dispatch(new DelegacionEvent($DTO), DelegacionEvent::DELEGACION_ASOCIAR_AUDITOR);


    }
    /**
     * @Rest\Route("", methods={"GET"})
     * @View(serializerGroups={"list"})
     * @return JsonResponse
     */
    public function list(){

        return $this->manager->getList(['user'=>$this->getUser()]);

    }
    /**
     * @Rest\Route("/{uuid}", methods={"GET"})
     * @ParamConverter("test", options={"mapping": {"uuid": "uuid"}})
     * @param TestUsuario $test
     * @return TestUsuario
     * @View(serializerGroups={"list"})
     */
    public function getOne(TestUsuario $test){

        return $test;
    }

}
