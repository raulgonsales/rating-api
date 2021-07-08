<?php declare(strict_types=1);

namespace App\Controller\Rating\RequestPayload;

use App\Controller\RequestPayload\BaseRequestPayload;
use Symfony\Component\Validator\Constraints as Assert;

class StoreRequestPayload implements BaseRequestPayload
{
    /** @var int */
    private $projectId;

    /**
     * @var int
     * @Assert\Range(
     *     min="1",
     *     max="5"
     * )
     */
    private $feedbackOverallRating;
    
    /**
     * @var int
     * @Assert\Range(
     *     min="1",
     *     max="5"
     * )
     */
    private $feedbackCommunicationRating;
    
    /**
     * @var int
     * @Assert\Range(
     *     min="1",
     *     max="5"
     * )
     */
    private $feedbackQualityRating;
    
    /**
     * @var int
     * @Assert\Range(
     *     min="1",
     *     max="5"
     * )
     */
    private $feedbackPricingRating;

    /** @var string|null */
    private $feedbackImprovementText;

    /**
     * @param  int          $projectId
     * @param  int          $feedbackOverallRating
     * @param  int          $feedbackCommunicationRating
     * @param  int          $feedbackQualityRating
     * @param  int          $feedbackPricingRating
     * @param  string|null  $feedbackImprovementText
     */
    public function __construct(
        int $projectId,
        int $feedbackOverallRating,
        int $feedbackCommunicationRating,
        int $feedbackQualityRating,
        int $feedbackPricingRating,
        ?string $feedbackImprovementText
    ) {
        $this->projectId = $projectId;
        $this->feedbackOverallRating = $feedbackOverallRating;
        $this->feedbackCommunicationRating = $feedbackCommunicationRating;
        $this->feedbackQualityRating = $feedbackQualityRating;
        $this->feedbackPricingRating = $feedbackPricingRating;
        $this->feedbackImprovementText = $feedbackImprovementText;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @return int
     */
    public function getFeedbackOverallRating(): int
    {
        return $this->feedbackOverallRating;
    }

    /**
     * @return int
     */
    public function getFeedbackCommunicationRating(): int
    {
        return $this->feedbackCommunicationRating;
    }

    /**
     * @return int
     */
    public function getFeedbackQualityRating(): int
    {
        return $this->feedbackQualityRating;
    }

    /**
     * @return int
     */
    public function getFeedbackPricingRating(): int
    {
        return $this->feedbackPricingRating;
    }

    /**
     * @return string|null
     */
    public function getFeedbackImprovementText(): ?string
    {
        return $this->feedbackImprovementText;
    }
}
