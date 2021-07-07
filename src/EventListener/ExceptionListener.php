<?php declare(strict_types=1);

namespace App\EventListener;

use App\Factory\NormalizerFactory;
use App\Http\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    /**
     * @var NormalizerFactory
     */
    private $normalizerFactory;
    
    /**
     * @param NormalizerFactory $normalizerFactory
     */
    public function __construct(NormalizerFactory $normalizerFactory)
    {
        $this->normalizerFactory = $normalizerFactory;
    }
    
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
    
        $response = $this->createApiResponse($exception);
        $event->setResponse($response);
    }
    
    /**
     * Creates the ApiResponse from any Exception
     *
     * @param  \Exception  $exception
     *
     * @return ApiResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    private function createApiResponse(\Throwable $exception): ApiResponse
    {
        $normalizer = $this->normalizerFactory->getNormalizer($exception);
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
    
        try {
            $errors = $normalizer ? $normalizer->normalize($exception) : [];
        } catch (\Exception $e) {
            $errors = [];
        }
        
        return new ApiResponse($exception->getMessage(), null, $errors, $statusCode);
    }
}
