<?php declare(strict_types=1);

namespace App\Serializer;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class HttpExceptionNormalizer implements NormalizerInterface
{
    /**
     * @param  mixed  $object
     * @param  string|null  $format
     * @param  array<int,string>  $context
     * @return array<int,string>
     */
    public function normalize($object, string $format = null, array $context = []): array
    {
        $data = [];
        
        if ($object instanceof HttpExceptionInterface) {
            $data[] = $object->getMessage();
        }
        
        return $data;
    }

    /**
     * @param  mixed  $data
     * @param  string|null  $format
     * @return bool
     */
    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof HttpExceptionInterface;
    }
}
