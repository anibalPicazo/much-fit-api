<?php


namespace App\Serializer;


use Doctrine\Common\Persistence\ManagerRegistry;
use JMS\Serializer\Context;
use JMS\Serializer\Exception\InvalidArgumentException;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\SerializerBuilder;

/**
 * Class EntityHandler
 * @package App\Serializer
 */
class ApiHandler implements SubscribingHandlerInterface
{
    private $entityManager;

    /**
     * EntityHandler constructor.
     * @param ManagerRegistry $entityManager
     */
    public function __construct(ManagerRegistry $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public static function getSubscribingMethods()
    {
        $methods = [];
        foreach (['json', 'xml', 'yml'] as $format) {
            $methods[] = [
                'type' => 'Entity',
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => $format,
                'method' => 'deserializeEntity',
            ];

            $methods[] = [
                'type' => 'Entity',
                'format' => $format,
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'method' => 'serializeEntity',
            ];
        }

        return $methods;
    }

    /**
     * @param                                            $visitor
     * @param                                            $entity
     * @param array $type
     * @param \JMS\Serializer\Context $context
     * @return mixed
     */
    public function serializeEntity($visitor, $entity, array $type, Context $context)
    {
        if ($type['name'] === 'Entity') {
            $serializer = SerializerBuilder::create()->build();
            $data = (clone $serializer)->serialize($entity, 'json');

            return $data;
        }
    }

    /**
     * @param                                  $visitor
     * @param $uuid
     * @param array $type
     * @return object|null
     */
    public function deserializeEntity($visitor, $uuid, array $type)
    {
        if (null === $uuid && $type['name'] !== 'Entity') {
            return null;
        }

        if (!(is_array($type) && isset($type['params']) && is_array($type['params']) && isset($type['params']['0']))) {
            return null;
        }

        $entityClass = $type['params'][0]['name'];
        $isCollection = array_key_exists(1, $type['params']) && ($type['params'][1]['name'] === 'collection');

        $results = ($isCollection)
            ? $this->entityManager->getRepository($entityClass)->findBy(['uuid' => $uuid])
            : $this->entityManager->getRepository($entityClass)->findOneBy(['uuid' => $uuid]);

        return $results;
    }


    /**
     * @param string $entityClass
     * @return
     */
    protected function getEntityManager($entityClass)
    {
        $entityManager = $this->entityManager->getEntityManagerForClass($entityClass);
        if (!$entityManager) {
            throw new InvalidArgumentException(
                sprintf("Entity class '%s' is not mannaged by Doctrine", $entityClass)
            );
        }

        return $entityManager;
    }

}
