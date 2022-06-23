<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodRepository::class)
 */
class Food
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
     * @ORM\Column(type="float")
     */
    private $Price;

    /**
     * @ORM\ManyToOne(targetEntity=Chef::class, inversedBy="type")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ChefID;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="type")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategoryID;

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

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getChefID(): ?Chef
    {
        return $this->ChefID;
    }

    public function setChefID(?Chef $ChefID): self
    {
        $this->ChefID = $ChefID;

        return $this;
    }

    public function getCategoryID(): ?Category
    {
        return $this->CategoryID;
    }

    public function setCategoryID(?Category $CategoryID): self
    {
        $this->CategoryID = $CategoryID;

        return $this;
    }
}
