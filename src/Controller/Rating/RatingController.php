<?php declare(strict_types=1);

namespace App\Controller\Rating;

use App\Controller\Rating\RequestPayload\StoreRequestPayload;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/rating")
 */
class RatingController extends AbstractController
{
    /**
     * @Route("/store", methods={"POST"})
     * @ParamConverter("store", class="App\Controller\Rating\RequestPayload\StoreRequestPayload")
     */
    public function storeRating(StoreRequestPayload $requestPayload): Response
    {
        return $this->json(['test', 'kek']);
    }
}
