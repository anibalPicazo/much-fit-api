<?php


namespace App\Service\Managers;

use App\DTO\DTOInterface;
use App\Entity\User;
use App\Serializer\ApiRestErrorNormalizer;
use App\Service\Events\EventStore;
use App\Service\Forms\DTOFormFactory;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

abstract class AbstractManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $doctrine;
    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;
    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;
    /**
     * @var EventStore
     */
    protected $eventStore;
    /**
     * @var UserPasswordEncoderInterface
     */
    protected $encoder;
    /**
     * @var DTOFormFactory
     */
    protected $formFactory;
    /**
     * @var ApiRestErrorNormalizer
     */
    protected $normalizer;

    /**
     * AbstractService constructor.
     * @param UserPasswordEncoderInterface $encoder
     * @param ApiRestErrorNormalizer $normalizer
     * @param DTOFormFactory $formFactory
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $tokenStorage
     * @param EventDispatcherInterface $dispatcher
     * @param EventStore $eventStore
     */
    public function __construct(
        UserPasswordEncoderInterface $encoder,
        ApiRestErrorNormalizer $normalizer,
        DTOFormFactory $formFactory,
        EntityManagerInterface $doctrine,
        TokenStorageInterface $tokenStorage,
        EventDispatcherInterface $dispatcher,
        EventStore $eventStore
    ) {
        $this->doctrine = $doctrine;
        $this->formFactory = $formFactory;
        $this->normalizer = $normalizer;
        $this->tokenStorage = $tokenStorage;
        $this->dispatcher = $dispatcher;
        $this->eventStore = $eventStore;
        $this->encoder = $encoder;
    }

    /**
     * @param array $params
     * @return object[]
     */
    public function getList($params = [])
    {
        return $this->getRepository()->findBy($params,['id' => 'DESC']);
    }

    /**
     * @return ObjectRepository
     */
    abstract protected function getRepository();

    /**
     * @param array $params
     * @return object[]
     */
    public function findBy(array $params)
    {
        return $this->getRepository()->findBy($params);
    }

    /**
     * Get Item
     * @param string $id
     * @return object|null
     */
    public function findById(string $id)
    {
        return $this->getRepository()->findOneBy(['id' => $id]);
    }

    /**
     * @param string $uuid
     * @return object|null
     */
    public function findByUuid(string $uuid)
    {
        return $this->getRepository()->findOneBy(['uuid' => $uuid]);
    }

    /**
     * @param DTOInterface $DTO
     * @param FormInterface $form
     * @param $method
     * @return mixed|JsonResponse
     * @throws ExceptionInterface
     * @throws \ReflectionException
     */
    public function processDTOForm(DTOInterface $DTO, FormInterface $form, $method)
    {
        $formFactory = $this->formFactory->createFromDTO($DTO);
        $formFactory->submit($form, $method);
        if ($formFactory->isValid()) {
            return $formFactory->save();
        } else {
            return new JsonResponse(
                ['status' => 'error', 'errors' => $this->normalizer->normalize($formFactory->getForm()->getErrors())],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * @param $entity
     */
    public function remove($entity)
    {
        $this->doctrine->remove($entity);
        $this->doctrine->flush();
    }

    /**
     * @param $entity
     */
    public function save($entity)
    {
        $this->doctrine->persist($entity);
        $this->doctrine->flush();
    }


    public function beginTransaction()
    {
        $this->doctrine->getConnection()->beginTransaction();
    }

    public function rollback()
    {
        $this->doctrine->getConnection()->rollBack();
    }

    public function commit()
    {
        $this->doctrine->getConnection()->commit();
    }

    /**
     * @return User
     */
    public function getCurrent() : User{
        return $this->tokenStorage->getToken()->getUser();
    }
}
