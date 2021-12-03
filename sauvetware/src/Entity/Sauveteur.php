<?php

namespace App\Entity;

use App\Repository\SauveteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SauveteurRepository::class)
 */
class Sauveteur
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
    private $patronyme;

    /**
     * @ORM\Column(type="boolean")
     */
    private $family;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $birth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $death;

    /**
     * @ORM\Column(type="string", length=2048)
     */
    private $maried;

    /**
     * @ORM\Column(type="string", length=2048)
     */
    private $children;

    /**
     * @ORM\Column(type="string", length=512)
     */
    private $child_of;

    /**
     * @ORM\Column(type="string", length=4096)
     */
    private $infos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatronyme(): ?string
    {
        return $this->patronyme;
    }

    public function setPatronyme(string $patronyme): self
    {
        $this->patronyme = $patronyme;

        return $this;
    }

    public function getFamily(): ?bool
    {
        return $this->family;
    }

    public function setFamily(bool $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getBirth(): ?string
    {
        return $this->birth;
    }

    public function setBirth(string $birth): self
    {
        $this->birth = $birth;

        return $this;
    }

    public function getDeath(): ?string
    {
        return $this->death;
    }

    public function setDeath(string $death): self
    {
        $this->death = $death;

        return $this;
    }

    public function getMaried(): ?string
    {
        return $this->maried;
    }

    public function setMaried(string $maried): self
    {
        $this->maried = $maried;

        return $this;
    }

    public function getChildren(): ?string
    {
        return $this->children;
    }

    public function setChildren(string $children): self
    {
        $this->children = $children;

        return $this;
    }

    public function getChildOf(): ?string
    {
        return $this->child_of;
    }

    public function setChildOf(string $child_of): self
    {
        $this->child_of = $child_of;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
