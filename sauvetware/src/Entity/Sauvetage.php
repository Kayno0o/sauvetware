<?php

namespace App\Entity;

use App\Repository\SauvetageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SauvetageRepository::class)
 */
class Sauvetage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $saved;

    /**
     * @ORM\Column(type="text")
     */
    private $infos;

    /**
     * @ORM\ManyToMany(targetEntity=Sauveteur::class, inversedBy="sauvetages")
     */
    private $sauveteurs;

    public function __construct()
    {
        $this->sauveteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getSaved(): ?string
    {
        return $this->saved;
    }

    public function setSaved(string $saved): self
    {
        $this->saved = $saved;

        return $this;
    }

    public function getInfos(): ?string
    {
        return $this->infos;
    }

    public function setInfos(string $infos): self
    {
        $this->infos = $infos;

        return $this;
    }

    /**
     * @return Collection|Sauveteur[]
     */
    public function getSauveteurs(): Collection
    {
        return $this->sauveteurs;
    }

    public function addSauveteur(Sauveteur $sauveteur): self
    {
        if (!$this->sauveteurs->contains($sauveteur)) {
            $this->sauveteurs[] = $sauveteur;
        }

        return $this;
    }

    public function removeSauveteur(Sauveteur $sauveteur): self
    {
        $this->sauveteurs->removeElement($sauveteur);

        return $this;
    }
}
