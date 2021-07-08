<?php declare(strict_types=1);

namespace App\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    /**
     * @param string $message
     * @param mixed  $data
     * @param array<int,string>  $errors
     * @param int    $status
     * @param array<string,string>  $headers
     * @param bool   $json
     */
    public function __construct(string $message, $data = null, array $errors = [], int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($this->format($message, $data, $errors), $status, $headers, $json);
    }
    
    /**
     * Format the API response.
     *
     * @param string $message
     * @param mixed  $data
     * @param array<int,string>  $errors
     *
     * @return array<string,mixed>
     */
    private function format(string $message, $data = null, array $errors = []): array
    {
        if ($data === null) {
            $data = new \ArrayObject();
        }
        
        $response = [
            'message' => $message,
            'data'    => $data,
        ];
        
        if ($errors) {
            $response['errors'] = $errors;
        }
        
        return $response;
    }
}
