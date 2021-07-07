<?php declare(strict_types=1);

namespace App\Serializer;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class HttpExceptionNormalizer implements NormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        $data = [];
        
        if ($object instanceof HttpExceptionInterface) {
            $data[] = $object->getMessage();
        }
        
        return $data;
    }
    
    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof HttpExceptionInterface;
    }
}
