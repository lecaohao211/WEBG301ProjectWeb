<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodRepository::class)
 */
class Food
{
//    /**
//     * @var \Category
//     *
//     * @ORM\ManyToOne(targetEntity="Category")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="category", referencedColumnName="id")
//     * })
//     */
//    private $categoryCategory;

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
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="type")
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Chef::class, inversedBy="type")
     */
    private $chefID;

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

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getChefID(): ?chef
    {
        return $this->chefID;
    }

    public function setChefID(?chef $chefID): self
    {
        $this->chefID = $chefID;

        return $this;
    }





}
