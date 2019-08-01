<?php


namespace App\Service\Managers;

use App\DTO\DTOInterface;
use App\Serializer\ApiRestErrorNormalizer;
use App\Service\Forms\DTOFormFactory;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
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
     * @var DTOFormFactory
     */
    private $formFactory;
    /**
     * @var ApiRestErrorNormalizer
     */
    private $normalizer;

    /**
     * AbstractService constructor.
     * @param ApiRestErrorNormalizer $normalizer
     * @param DTOFormFactory $formFactory
     * @param EntityManagerInterface $doctrine
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(ApiRestErrorNormalizer $normalizer, DTOFormFactory $formFactory, EntityManagerInterface $doctrine, TokenStorageInterface $tokenStorage)
    {
        $this->doctrine = $doctrine;
        $this->formFactory = $formFactory;
        $this->normalizer = $normalizer;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return object[]
     */
    public function getList()
    {
        return $this->getRepository()->findBy([]);
    }

    /**
     * @return ObjectRepository
     */
    abstract protected function getRepository();

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
                ['status' => 'error', 'errors' => $this->normalizer->normalize($form)],
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

}
