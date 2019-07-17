<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"resume:read"}},
 *     denormalizationContext={"groups"={"resume:write"}}
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *     "user.id": "exact"
 * })
 * @ORM\Entity(repositoryClass="App\Repository\ResumeRepository")
 */
class Resume
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"user:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"resume:read", "resume:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"resume:read", "resume:write"})
     */
    private $situation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"resume:read", "resume:write"})
     */
    private $accroche;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="resume", cascade={"persist", "remove"})
     * @Groups({"resume:read"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Realisation", mappedBy="resume")
     * @Groups({"resume:read"})
     */
    private $realisations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Experience", mappedBy="resume")
     * @Groups({"resume:read", "resume:write"})
     */
    private $experiences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"resume:read", "resume:write"})
     */
    private $softSkills;

    public function __construct()
    {
        $this->realisations = new ArrayCollection();
        $this->experiences = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function setSituation(?string $situation): self
    {
        $this->situation = $situation;

        return $this;
    }

    public function getAccroche(): ?string
    {
        return $this->accroche;
    }

    public function setAccroche(?string $accroche): self
    {
        $this->accroche = $accroche;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newResume = $user === null ? null : $this;
        if ($newResume !== $user->getResume()) {
            $user->setResume($newResume);
        }

        return $this;
    }

    /**
     * @return Collection|Realisation[]
     */
    public function getRealisations(): Collection
    {
        return $this->realisations;
    }

    public function addRealisation(Realisation $realisation): self
    {
        if (!$this->realisations->contains($realisation)) {
            $this->realisations[] = $realisation;
            $realisation->setResume($this);
        }

        return $this;
    }

    public function removeRealisation(Realisation $realisation): self
    {
        if ($this->realisations->contains($realisation)) {
            $this->realisations->removeElement($realisation);
            // set the owning side to null (unless already changed)
            if ($realisation->getResume() === $this) {
                $realisation->setResume(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setResume($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->contains($experience)) {
            $this->experiences->removeElement($experience);
            // set the owning side to null (unless already changed)
            if ($experience->getResume() === $this) {
                $experience->setResume(null);
            }
        }

        return $this;
    }

    public function getSoftSkills(): ?string
    {
        return $this->softSkills;
    }

    public function setSoftSkills(?string $softSkills): self
    {
        $this->softSkills = $softSkills;

        return $this;
    }

}
