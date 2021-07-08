<?php declare(strict_types=1);

namespace App\Controller\Rating;

use App\Controller\Rating\Exception\ProjectNotFoundException;
use App\Controller\Rating\RequestPayload\StoreRequestPayload;
use App\Entity\Project;
use App\Helpers\PayloadValidatorException;
use App\Helpers\PayloadValidatorHelper;
use App\Http\ApiResponse;
use Doctrine\DBAL\Exception;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/v1/rating")
 */
class RatingController extends AbstractController
{
    
    /** @var LoggerInterface */
    private $logger;

    /** @var PayloadValidatorHelper */
    private $payloadValidatorHelper;
    
    public function __construct(LoggerInterface $logger, PayloadValidatorHelper $payloadValidatorHelper)
    {
        $this->logger = $logger;
        $this->payloadValidatorHelper = $payloadValidatorHelper;
    }
    
    /**
     * @Route("/store", methods={"PUT"})
     * @ParamConverter("requestPayload", converter="fos_rest.request_body")
     * @OA\Put(
     *     path="/rating/store",
     *     summary="Stores rating given from project creator to Vico on a specific project.",
     *     tags={"rating"},
     *     @OA\RequestBody(
     *         description="JSON Payload",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 maxProperties=6,
     *                 minProperties=5,
     *                 type="object",
     *                 required={"projectId","feedbackOverallRating","feedbackCommunicationRating","feedbackQualityRating","feedbackPricingRating"},
     *                 @OA\Property(
     *                     property="projectId",
     *                     type="integer",
     *                     example=65
     *                 ),
     *                 @OA\Property(
     *                     property="feedbackOverallRating",
     *                     type="integer",
     *                     example=5
     *                 ),
     *                 @OA\Property(
     *                     property="feedbackCommunicationRating",
     *                     type="integer",
     *                     example=3
     *                 ),
     *                 @OA\Property(
     *                     property="feedbackQualityRating",
     *                     type="integer",
     *                     example=4
     *                 ),
     *                 @OA\Property(
     *                     property="feedbackPricingRating",
     *                     type="integer",
     *                     example=4
     *                 ),
     *                 @OA\Property(
     *                     property="feedbackImprovementText",
     *                     type="string",
     *                     example="Good job!"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success."
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Could not find project by id."
     *     )
     * )
     * @throws ProjectNotFoundException
     * @throws Exception
     */
    public function storeRating(StoreRequestPayload $requestPayload): ApiResponse
    {
        $logContext = [
            'project_id' => $requestPayload->getProjectId(),
            'payload' => $requestPayload
        ];

        try {
            $this->payloadValidatorHelper->validatePayload($requestPayload);
            $projectEntity = $this->getDoctrine()->getRepository(Project::class)->find($requestPayload->getProjectId());
        } catch (PayloadValidatorException $exception) {
            $this->logger->info('Validation failed on request payload.', $logContext);
            throw new BadRequestHttpException($exception->getMessage(), $exception);
        } catch (Exception $exception) {
            $this->logger->critical('Error getting project from database.', $logContext);
            throw $exception;
        }

        if ($projectEntity === null) {
            $this->logger->info('Request with given Id not found', $logContext);
            throw new ProjectNotFoundException(404, 'Project with ID ' . $requestPayload->getProjectId() .  ' not found.');
        }

        $projectEntity->setFeedbackOverallRating($requestPayload->getFeedbackOverallRating());
        $projectEntity->setFeedbackCommunicationRating($requestPayload->getFeedbackCommunicationRating());
        $projectEntity->setFeedbackQualityRating($requestPayload->getFeedbackQualityRating());
        $projectEntity->setFeedbackPricingRating($requestPayload->getFeedbackPricingRating());
        $projectEntity->setFeedbackImprovementText($requestPayload->getFeedbackImprovementText());

        try {
            $this->getDoctrine()->getManager()->persist($projectEntity);
            $this->getDoctrine()->getManager()->flush();
        } catch (Exception $exception) {
            $this->logger->critical('Error storing data to database.', $logContext);
            throw $exception;
        }

        return new ApiResponse('Success', [
            'projectId' => $projectEntity->getId()
        ]);
    }
}
