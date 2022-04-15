<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 */
class Picture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"User:exo2","User:exo4"})
     */
    private $large;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"User:exo2","User:exo4"})
     */
    private $medium;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"User:exo2","User:exo4"})
     */
    private $thumbnail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLarge(): ?string
    {
        return $this->large;
    }

    public function setLarge(string $large): self
    {
        $this->large = $large;

        return $this;
    }

    public function getMedium(): ?string
    {
        return $this->medium;
    }

    public function setMedium(?string $medium): self
    {
        $this->medium = $medium;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
}
