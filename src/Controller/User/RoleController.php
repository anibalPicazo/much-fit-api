<?php

namespace App\Controller\User;

use App\DTO\User\RoleCreateDTO;
use App\Entity\Role;
use App\Form\RoleType;
use App\Service\Managers\User\RoleManager;
use App\Validator\DTOValidator;
use ReflectionException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;


/**
 * @Route("/roles")
 */
class RoleController extends AbstractController
{
    /**
     * @var DTOValidator
     */
    private $validator;
    /**
     * @var RoleManager
     */
    private $manager;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * UserController constructor.
     * @param DTOValidator $validator
     * @param RoleManager $manager
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(DTOValidator $validator, RoleManager $manager, EventDispatcherInterface $dispatcher)
    {
        $this->validator = $validator;
        $this->dispatcher = $dispatcher;
        $this->manager = $manager;
    }

    /**
     * @Route("",  methods={"GET"})
     */
    public function getAllRoles()
    {
        return $this->manager->getList();
    }

    /**
     * @Route("/{uuid}",   methods={"GET"})
     * @param string $uuid
     * @return Object|null
     */
    public function getRole(string $uuid): ?Role
    {
        return $this->manager->findByUuid($uuid);
    }

    /**
     * @Route("",  methods={"POST"})
     * @param RoleCreateDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     * @throws ReflectionException
     *
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     */
    public function createRole(RoleCreateDTO $DTO, Request $request)
    {
        // SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_ROOT);

        //VALIDATION
        $errors = $this->validator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        //COMMAND
        $form = $this->createForm(RoleType::class, $DTO);
        $this->manager->processDTOForm($DTO, $form, $request->getMethod());

        //RESPONSE
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
