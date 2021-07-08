<?php declare(strict_types=1);

namespace App\Tests\Http;

use App\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ApiResponseTest extends TestCase
{
    public function testFormatApiResponse()
    {
        $apiResponse = new ApiResponse(
            'An error was occurred.',
            ['data' => 'test_data'],
            [
                'validation error',
                'bad method called',
            ],
            404
        );

        $this->assertSame('{"message":"An error was occurred.","data":{"data":"test_data"},"errors":["validation error","bad method called"]}', $apiResponse->getContent());
        $this->assertSame(404, $apiResponse->getStatusCode());
    }
}
