<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $article_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $article_created;

    /**
     * @ORM\Column(type="datetime")
     */
    private $article_published;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $article_title;

    /**
     * @ORM\Column(type="text")
     */
    private $article_body;

    /**
     * @ORM\Column(type="smallint")
     */
    private $article_active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleId(): ?int
    {
        return $this->article_id;
    }

    public function setArticleId(int $article_id): self
    {
        $this->article_id = $article_id;

        return $this;
    }

    public function getArticleCreated(): ?\DateTimeInterface
    {
        return $this->article_created;
    }

    public function setArticleCreated(\DateTimeInterface $article_created): self
    {
        $this->article_created = $article_created;

        return $this;
    }

    public function getArticlePublished(): ?\DateTimeInterface
    {
        return $this->article_published;
    }

    public function setArticlePublished(\DateTimeInterface $article_published): self
    {
        $this->article_published = $article_published;

        return $this;
    }

    public function getArticleTitle(): ?string
    {
        return $this->article_title;
    }

    public function setArticleTitle(string $article_title): self
    {
        $this->article_title = $article_title;

        return $this;
    }

    public function getArticleBody(): ?string
    {
        return $this->article_body;
    }

    public function setArticleBody(string $article_body): self
    {
        $this->article_body = $article_body;

        return $this;
    }

    public function getArticleActive(): ?int
    {
        return $this->article_active;
    }

    public function setArticleActive(int $article_active): self
    {
        $this->article_active = $article_active;

        return $this;
    }
}
