<?php

namespace App\Controller\User;

use App\DTO\User\UserRegisterDTO;
use App\Service\Managers\User\UserManager;
use App\Validator\DTOValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;



/**
 * @Route("/register")
 */
class RegisterController extends AbstractController
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
     * @Route("/register",  methods={"POST"})
     * @ParamConverter("DTO", converter="api.rest.dto.converter")
     * @param UserRegisterDTO $DTO
     * @param Request $request
     * @return JsonResponse
     * @throws ExceptionInterface
     */
    public function register(UserRegisterDTO $DTO, Request $request){
        //SECURITY


        //VALIDATION
        $errors = $this->DTOValidator->validate($request);
        if ($errors) {
            return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }
        //COMAND
        $this->manager->register($DTO);
        //RESPONSE
        return new JsonResponse(null, Response::HTTP_CREATED);

    }


}
