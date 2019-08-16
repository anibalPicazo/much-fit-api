<?php


namespace App\Controller\TestController;


use App\DTO\TestUsuario\TestUsuarioEntrenamientoCreateDTO;
use App\Entity\Role;
use App\Service\Managers\TestManager\TestEntrenamientoManager;
use App\Validator\DTOValidator;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     */
    public function createTest(TestUsuarioEntrenamientoCreateDTO $DTO, Request $request){
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


}
