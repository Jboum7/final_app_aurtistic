<?php

namespace App\Entity;

use App\Repository\SettingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingRepository::class)]
class Setting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $fontSize = null;

    #[ORM\Column]
    private ?int $fontWeight = null;

    #[ORM\Column(length: 50)]
    private ?string $fontStretch = null;

    #[ORM\OneToOne(inversedBy: 'setting', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $theme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFontSize(): ?float
    {
        return $this->fontSize;
    }

    public function setFontSize(float $fontSize): static
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    public function getFontWeight(): ?int
    {
        return $this->fontWeight;
    }

    public function setFontWeight(int $fontWeight): static
    {
        $this->fontWeight = $fontWeight;

        return $this;
    }

    public function getFontStretch(): ?string
    {
        return $this->fontStretch;
    }

    public function setFontStretch(string $fontStretch): static
    {
        $this->fontStretch = $fontStretch;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }
}
