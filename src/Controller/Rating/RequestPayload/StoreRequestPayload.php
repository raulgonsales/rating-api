<?php declare(strict_types=1);

namespace App\Controller\Rating\RequestPayload;

class StoreRequestPayload
{
    /** @var int */
    private $projectId;

    /** @var int */
    private $feedbackRating;

    /** @var string|null */
    private $feedbackImprovementText;

    /**
     * @param  int          $projectId
     * @param  int          $feedbackRating
     * @param  string|null  $feedbackImprovementText
     */
    public function __construct(int $projectId, int $feedbackRating, ?string $feedbackImprovementText)
    {
        $this->projectId = $projectId;
        $this->feedbackRating = $feedbackRating;
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
    public function getFeedbackRating(): int
    {
        return $this->feedbackRating;
    }

    /**
     * @return string|null
     */
    public function getFeedbackImprovementText(): ?string
    {
        return $this->feedbackImprovementText;
    }
}
