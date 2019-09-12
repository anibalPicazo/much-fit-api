<?php


namespace App\Serializer;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Form\FormError;

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
     * @param $data
     * @return array
     */
    private function convertToArray($data)
    {
        $errors = [];

        foreach ($data as $error) {
            $typeof = get_class($error);
            switch ($typeof) {
                case 'Symfony\Component\Form\FormError':
                    /** FormError $error */
                    $key = $error->getCause()->getPropertyPath();
                    $errors[$key] = $error->getMessage();
                    break;

                case 'Symfony\Component\Validator\ConstraintViolation':
                    $errors[$error->getPropertyPath()] = $error->getMessage();
                    break;

            }
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
