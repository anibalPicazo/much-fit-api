<?php


namespace App\Serializer;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class ApiRestErrorNormalizer
 * @package App\Serializer
 */
class ApiRestErrorNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'code' => Response::HTTP_BAD_REQUEST,
            'message' => 'Validation Failed',
            'errors' => $this->convertToArray($object),
        ];
    }

    /**
     * This code has been taken from JMSSerializer.
     * @param \Symfony\Component\Validator\ConstraintViolationList $data
     * @return array
     */
    private function convertToArray(ConstraintViolationList $data)
    {
        $errors = [];

        foreach ($data->getIterator() as $error) {
            $errors[$error->getPropertyPath()] = $error->getMessage();
        }

        return $errors;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof FormInterface && $data->isSubmitted() && !$data->isValid();
    }

}
