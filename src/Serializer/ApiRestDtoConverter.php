<?php


namespace App\Serializer;


use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ApiRestDtoConverter
 * @package App\Serializer
 */
class ApiRestDtoConverter implements ParamConverterInterface
{
    /** @var \Doctrine\ORM\EntityManagerInterface */
    private $entityManager;
    /** @var \JMS\Serializer\SerializerInterface */
    private $serializer;
    /** @var \Symfony\Component\Validator\Validator\ValidatorInterface */
    private $validator;

    /**
     * ApiRestDtoConverter constructor.
     * @param \Doctrine\ORM\EntityManagerInterface                      $entityManager
     * @param \JMS\Serializer\SerializerInterface                       $serializer
     * @param \Symfony\Component\Validator\Validator\ValidatorInterface $validator
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        ValidatorInterface $validator = null
    ) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request                        $request
     * @param \Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter $configuration
     * @return bool|void
     */
    public function apply(Request $request, ParamConverter $configuration)
    {
        //todo: fix better
        $content = $request->getContent();
        if ($content == ""){
            $content = "{}";
        }
        $class = $configuration->getClass();

        try {
            $object = $this->serializer->deserialize(
                $content,
                $class,
                'json'
            );
        } catch (\JsonException $e) {
            throw new NotFoundHttpException(
                sprintf(
                    'Could not deserialize request content to object of type "%s"',
                    $class
                )
            );
        }

        $request->attributes->set($configuration->getName(), $object);
        $groups = null;
        $errors = $this->validator->validate($object, null, $groups);

        $request->attributes->set('validation_errors', $errors);
    }

    /**
     * @param \Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter $configuration
     * @return bool
     */
    public function supports(ParamConverter $configuration)
    {
        return $configuration->getConverter() == 'api.rest.dto.converter';
    }

}
