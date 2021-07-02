<?php declare(strict_types=1);

namespace App\Controller\Rating;

use App\Controller\Rating\RequestPayload\StoreRequestPayload;
use App\Entity\Project;
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
     * @Route("/store", methods={"PUT"})
     * @ParamConverter("requestPayload", converter="fos_rest.request_body")
     */
    public function storeRating(StoreRequestPayload $requestPayload): Response
    {
        /** @var Project $projectEntity */
        $projectEntity = $this->getDoctrine()->getRepository(Project::class)->find($requestPayload->getProjectId());
        $projectEntity->setFeedbackRating($requestPayload->getFeedbackRating());
        $projectEntity->setFeedbackImprovementText($requestPayload->getFeedbackImprovementText());
        
        $this->getDoctrine()->getManager()->persist($projectEntity);
        $this->getDoctrine()->getManager()->flush();
        
        return $this->json('Rating score ' . $projectEntity->getFeedbackRating() . ' for project ' . $projectEntity->getTitle() . ' is saved.');
    }
}
