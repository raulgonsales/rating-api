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
     * @ORM\Column(name="feedback_rating", type="integer", length=1, nullable="true")
     */
    private $feedbackRating;

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
    public function getFeedbackRating(): ?int
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
     * @param  int  $feedbackRating
     */
    public function setFeedbackRating(int $feedbackRating): void
    {
        $this->feedbackRating = $feedbackRating;
    }

    /**
     * @param  string  $feedbackImprovementText
     */
    public function setFeedbackImprovementText(string $feedbackImprovementText): void
    {
        $this->feedbackImprovementText = $feedbackImprovementText;
    }
}
