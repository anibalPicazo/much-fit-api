<?php

namespace App\Controller\User;

use App\DTO\User\AsignarEmpresaDTO;
use App\DTO\User\UserCreateDTO;
use App\Entity\Role;
use App\Entity\User;
use App\EventSubscriber\Event\UserEvent;
use App\Security\Voter\UserVoter;
use App\Service\Managers\User\UserManager;
use App\Validator\DTOValidator;
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
 * @Route("/users")
 */
class UserController extends AbstractController
{
    /**
     * @var DTOValidator
     */
    private $DTOValidator;
    /**
     * @var UserManager
     */
    private $manager;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * UserController constructor.
     * @param DTOValidator $DTOValidator
     * @param UserManager $manager
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(DTOValidator $DTOValidator, UserManager $manager, EventDispatcherInterface $dispatcher)
    {
        $this->DTOValidator = $DTOValidator;
        $this->manager = $manager;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @Route("",   methods={"GET"})
     * @View(serializerGroups={"list"})
     */
    public function getAllUsers()
    {
        return $this->getUser()->getEmpresa()->getUsers();
    }

    /**
     * @Route("/asignar",  methods={"POST"})
     * @View(serializerGroups={"list", "edit"})
     * @param AsignarEmpresaDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     */
    public function asignar(AsignarEmpresaDTO $DTO, Request $request)
    {
        // SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_ROOT);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        //COMMAND
        $user = $this->manager->asignarEmpresa($DTO);

        //EVENT
        $event = new UserEvent($DTO);
        $this->dispatcher->dispatch($event, UserEvent::USER_COMPANY_DESIGNATED);

        //RESPONSE
        return $user;
    }


    /**
     * @Route("/current",  methods={"GET"})
     * @View(serializerGroups={"list", "edit"})
     * @return mixed
     */
    public function getCurrentUser()
    {
        return $this->getUser();
    }

    /**
     * @Route("/{uuid}",   methods={"GET"})
     * @View(serializerGroups={"list", "edit"})
     * @param User $user
     * @return Object|null
     * @ParamConverter("user", options={"mapping": {"uuid": "uuid"}})
     *
     */
    public function getOne(User $user): ?User
    {
        // SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_ROOT);
        $this->denyAccessUnlessGranted(UserVoter::VIEW, $user);

        return $user;
    }

    /**
     * @Route("",  methods={"POST"})
     * @View(serializerGroups={"list","edit"})
     * @param UserCreateDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     */
    public function createUser(UserCreateDTO $DTO, Request $request)
    {
        // SECURITY
        $this->denyAccessUnlessGranted(Role::ROLE_ROOT);

        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        //COMMAND
        $this->manager->createUser($DTO);

        //EVENT
        $event = new UserEvent($DTO);
        $this->dispatcher->dispatch($event, UserEvent::USER_CREATED);

        //RESPONSE
        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    /**
     * @Route("/{uuid}",  methods={"DELETE"})
     * @param User $user
     * @return JsonResponse
     */
    public function deleteUser(User $user)
    {
        $this->denyAccessUnlessGranted(Role::ROLE_ROOT);

        $this->manager->remove($user);

        return new JsonResponse(null, Response::HTTP_OK);

    }


}
