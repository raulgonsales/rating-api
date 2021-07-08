<?php declare(strict_types=1);

namespace App\Tests\EventListener;

use App\EventListener\ExceptionListener;
use App\Factory\NormalizerFactory;
use App\Http\ApiResponse;
use App\Serializer\HttpExceptionNormalizer;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionListenerTest extends TestCase
{
    public function testCreateApiResponseObjectFromException()
    {
        $httpExceptionNormalizer = new HttpExceptionNormalizer();

        $normalizeFactory = $this->createMock(NormalizerFactory::class);
        $normalizeFactory->expects($this->once())->method('getNormalizer')->willReturn($httpExceptionNormalizer);

        $exceptionListener = new ExceptionListener($normalizeFactory);

        $exceptionListenerReflectionClass = new ReflectionClass(ExceptionListener::class);
        $method = $exceptionListenerReflectionClass->getMethod('createApiResponse');
        $method->setAccessible(true);

        $response = $method->invokeArgs($exceptionListener, [
            new HttpException(404, 'An error was occurred.')
        ]);
        
        $this->assertInstanceOf(ApiResponse::class, $response);
        
        /** @var ApiResponse $response */
        $this->assertSame('{"message":"An error was occurred.","data":{},"errors":["An error was occurred."]}', $response->getContent());
    }
}
