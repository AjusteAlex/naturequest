<?php

namespace App\Entity;

use App\Repository\CoursePlantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursePlantRepository::class)
 */
class CoursePlant
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
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=ButtonPlant::class, mappedBy="stepId")
     */
    private $buttonPlants;
   

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|ButtonPlant[]
     */
    public function getButtonPlants(): Collection
    {
        return $this->buttonPlants;
    }

    public function addButtonPlant(ButtonPlant $buttonPlant): self
    {
        if (!$this->buttonPlants->contains($buttonPlant)) {
            $this->buttonPlants[] = $buttonPlant;
            $buttonPlant->setStepId($this);
        }

        return $this;
    }

    public function removeButtonPlant(ButtonPlant $buttonPlant): self
    {
        if ($this->buttonPlants->removeElement($buttonPlant)) {
            // set the owning side to null (unless already changed)
            if ($buttonPlant->getStepId() === $this) {
                $buttonPlant->setStepId(null);
            }
        }

        return $this;
    }

        public function __toString() { 
         return $this->title; 
     }


}