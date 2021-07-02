<?php declare(strict_types=1);

namespace App\Controller\Rating\RequestPayload;

class StoreRequestPayload
{
    /** @var int */
    private $id;

    /** @var int */
    private $feedbackRating;

    /** @var string|null */
    private $feedbackImprovementText;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
