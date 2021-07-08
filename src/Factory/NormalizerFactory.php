<?php declare(strict_types=1);

namespace App\Factory;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class NormalizerFactory
{
    /**
     * @var array<int,NormalizerInterface>
     */
    private $normalizers;
    
    /**
     * @param array<int,NormalizerInterface> $normalizers
     */
    public function __construct(array $normalizers)
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
