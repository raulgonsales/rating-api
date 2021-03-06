<?php declare(strict_types=1);

namespace App\Factory;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class NormalizerFactory
{
    /**
     * @var iterable<int,NormalizerInterface>
     */
    private $normalizers;
    
    /**
     * @param iterable<int,NormalizerInterface> $normalizers
     */
    public function __construct(iterable $normalizers)
    {
        $this->normalizers = $normalizers;
    }
    
    /**
     * Returns the normalizer by supported data.
     *
     * @param mixed $data
     *
     * @return NormalizerInterface|null
     */
    public function getNormalizer($data): ?NormalizerInterface
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer instanceof NormalizerInterface && $normalizer->supportsNormalization($data)) {
                return $normalizer;
            }
        }
        
        return null;
    }
}
