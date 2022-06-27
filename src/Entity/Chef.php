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
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $gender;

    /**
     * @ORM\Column(type="float")
     */
    private $salary;

    /**
     * @ORM\OneToMany(targetEntity=Food::class, mappedBy="chefID")
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
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): self
    {
        $this->salary = $salary;

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

    public function __toString()
    {
        return (string) $this->getName();
    }
}
