<?php

namespace App\Entity;

use App\Repository\BrandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandRepository::class)]
class Brand
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $exampleProduct = null;

    #[ORM\Column(nullable: true)]
    private ?int $exampleProductPrice = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'brands')]
    private Collection $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
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

    public function getExampleProduct(): ?string
    {
        return $this->exampleProduct;
    }

    public function setExampleProduct(string $exampleProduct): self
    {
        $this->exampleProduct = $exampleProduct;

        return $this;
    }

    public function getExampleProductPrice(): ?int
    {
        return $this->exampleProductPrice;
    }

    public function setExampleProductPrice(?int $exampleProductPrice): self
    {
        $this->exampleProductPrice = $exampleProductPrice;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }
}
