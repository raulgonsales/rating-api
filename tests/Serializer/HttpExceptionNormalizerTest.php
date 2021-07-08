<?php declare(strict_types=1);

namespace App\Tests\Serializer;

use App\Serializer\HttpExceptionNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HttpExceptionNormalizerTest extends TestCase
{
    public function testNormalize()
    {
        $exception = new HttpException(404, 'An exception triggered.');
        $httpNormalizer = new HttpExceptionNormalizer();
        $data = $httpNormalizer->normalize($exception);
        $this->assertSame('An exception triggered.', $data[0]);
    }
}
