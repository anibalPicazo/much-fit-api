<?php


namespace App\Service\DTO;


use App\DTO\DTOInterface;
use ReflectionProperty;
use function Lambdish\Phunctional\each as each;

/**
 * Class DTOExtractor
 * @package App\Service\DTO
 */
class DTOExtractor
{

    /**
     * @param DTOInterface $DTO
     * @return array
     * @throws \ReflectionException
     */
    public function extractData($DTO)
    {
        $reflecion = new \ReflectionClass($DTO);
        $properties = $reflecion->getProperties(ReflectionProperty::IS_PROTECTED);
        $data = [];

        each(function ($property) use (&$data, $DTO) {
            /* @var ReflectionProperty $property * */
            $property->setAccessible(true);
            $value = $property->getValue($DTO);
            if ($value)
                $data[$property->getName()] = $property->getValue($DTO);
        }, $properties);

        return $data;
    }

}
