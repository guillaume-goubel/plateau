<?php

namespace App\Entity;

use App\Util\TimestampableTrait;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Menu
{
    use TimestampableTrait;

    public function __construct()
    {
        if ($this->menuForAt === null) {
            $this->menuForAt = new \DateTime();
        }
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $name = 'Menu du jour';

    #[ORM\Column(length: 150)]
    private ?string $mainPicture = null;
    private $mainPictureFile;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $menuForAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getMainPicture(): ?string
    {
        return $this->mainPicture;
    }

    public function setMainPicture(string $mainPicture): static
    {
        $this->mainPicture = $mainPicture;

        return $this;
    }

    public function getMainPictureFile()
    {
        return $this->mainPictureFile;
    }

    public function setMainPictureFile($mainPictureFile): self
    {
        $this->mainPictureFile = $mainPictureFile;

        return $this;
    }

    public function getMenuForAt(): ?\DateTimeInterface
    {
        return $this->menuForAt;
    }

    public function setMenuForAt(\DateTimeInterface $menuForAt): static
    {
        $this->menuForAt = $menuForAt;

        return $this;
    }

}
