<?php declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="project")
 * @ORM\Entity()
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", length=11)
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="Client")
     */
    private $creator;

    /**
     * @var Vico
     *
     * @ORM\ManyToOne(targetEntity="Vico")
     */
    private $vico;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var int|null
     *
     * @ORM\Column(name="feedback_overall_rating", type="integer", length=1, nullable="true")
     */
    private $feedbackOverallRating;

    /**
     * @var int|null
     *
     * @ORM\Column(name="feedback_communication_rating", type="integer", length=1, nullable="true")
     */
    private $feedbackCommunicationRating;

    /**
     * @var int|null
     *
     * @ORM\Column(name="feedback_quality_rating", type="integer", length=1, nullable="true")
     */
    private $feedbackQualityRating;

    /**
     * @var int|null
     *
     * @ORM\Column(name="feedback_pricing_rating", type="integer", length=1, nullable="true")
     */
    private $feedbackPricingRating;

    /**
     * @var string|null
     *
     * @ORM\Column(name="feedback_improvement_text", type="text", nullable="true")
     */
    private $feedbackImprovementText;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Client
     */
    public function getCreator(): Client
    {
        return $this->creator;
    }

    /**
     * @return Vico
     */
    public function getVico(): Vico
    {
        return $this->vico;
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int|null
     */
    public function getFeedbackOverallRating(): ?int
    {
        return $this->feedbackOverallRating;
    }

    /**
     * @return int|null
     */
    public function getFeedbackCommunicationRating(): ?int
    {
        return $this->feedbackCommunicationRating;
    }

    /**
     * @return int|null
     */
    public function getFeedbackQualityRating(): ?int
    {
        return $this->feedbackQualityRating;
    }

    /**
     * @return int|null
     */
    public function getFeedbackPricingRating(): ?int
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

    /**
     * @param  Client  $creator
     */
    public function setCreator(Client $creator): void
    {
        $this->creator = $creator;
    }

    /**
     * @param  Vico  $vico
     */
    public function setVico(Vico $vico): void
    {
        $this->vico = $vico;
    }

    /**
     * @param  string  $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param  int  $feedbackOverallRating
     */
    public function setFeedbackOverallRating(int $feedbackOverallRating): void
    {
        $this->feedbackOverallRating = $feedbackOverallRating;
    }

    /**
     * @param  int|null  $feedbackCommunicationRating
     */
    public function setFeedbackCommunicationRating(?int $feedbackCommunicationRating): void
    {
        $this->feedbackCommunicationRating = $feedbackCommunicationRating;
    }

    /**
     * @param  int|null  $feedbackQualityRating
     */
    public function setFeedbackQualityRating(?int $feedbackQualityRating): void
    {
        $this->feedbackQualityRating = $feedbackQualityRating;
    }

    /**
     * @param  int|null  $feedbackPricingRating
     */
    public function setFeedbackPricingRating(?int $feedbackPricingRating): void
    {
        $this->feedbackPricingRating = $feedbackPricingRating;
    }

    /**
     * @param  string  $feedbackImprovementText
     */
    public function setFeedbackImprovementText(string $feedbackImprovementText): void
    {
        $this->feedbackImprovementText = $feedbackImprovementText;
    }
}
