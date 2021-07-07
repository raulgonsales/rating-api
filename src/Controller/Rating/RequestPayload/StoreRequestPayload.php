<?php declare(strict_types=1);

namespace App\Controller\Rating\RequestPayload;

class StoreRequestPayload
{
    /** @var int */
    private $projectId;

    /** @var int */
    private $feedbackOverallRating;

    /** @var int */
    private $feedbackCommunicationRating;

    /** @var int */
    private $feedbackQualityRating;

    /** @var int */
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
