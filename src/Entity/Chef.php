<?php

namespace App\Entity;

use App\Repository\ChefRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChefRepository::class)
 */
class Chef
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
    private $Name;

    /**
     * @ORM\Column(type="text")
     */
    private $Gender;

    /**
     * @ORM\Column(type="float")
     */
    private $Salary;

    /**
     * @ORM\OneToMany(targetEntity=Food::class, mappedBy="ChefID")
     */
    private $type;

    public function __construct()
    {
        $this->type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->Salary;
    }

    public function setSalary(float $Salary): self
    {
        $this->Salary = $Salary;

        return $this;
    }

    /**
     * @return Collection<int, Food>
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(Food $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
            $type->setChefID($this);
        }

        return $this;
    }

    public function removeType(Food $type): self
    {
        if ($this->type->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getChefID() === $this) {
                $type->setChefID(null);
            }
        }

        return $this;
    }
}