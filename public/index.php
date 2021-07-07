<?php

use App\Kernel;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="Vico rating system API", version="1.0.0")
 */

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
