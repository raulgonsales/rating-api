<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Factory\NormalizerFactory;
use App\Serializer\HttpExceptionNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class NormalizerFactoryTest extends TestCase
{
    public function testGetNormalizerReturnsCorrectNormalizerWhenHttpExceptionGiven()
    {
        $normalizers = [
            new HttpExceptionNormalizer()
        ];
        $normalizerFactory = new NormalizerFactory($normalizers);

        $exception = new HttpException(404, 'An error wa occurred.');
        $this->assertInstanceOf(HttpExceptionNormalizer::class, $normalizerFactory->getNormalizer($exception));
    }

    public function testGetNormalizerReturnsCorrectNormalizerWhenExceptionGiven()
    {
        $normalizers = [
            new HttpExceptionNormalizer()
        ];
        $normalizerFactory = new NormalizerFactory($normalizers);
        
        $exception = new \Exception('An error wa occurred.');
        $this->assertNotInstanceOf(HttpExceptionNormalizer::class, $normalizerFactory->getNormalizer($exception));
    }
}
