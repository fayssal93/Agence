<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

 
class Recherche
{
   
    /**
     * @var int|null
     * @Assert\Range(
     *      min = 20,
     *      max = 800,
     *      notInRangeMessage = " la surface doit etre entre {{ min }}m² et {{ max }}m² ",
     * )
     */
    private $minSurface;

    /**
     * @var int|null
     * @Assert\Range(
     *      min = 70000,
     *      max = 1000000,
     *      notInRangeMessage = " Le prix maximal doit etre entre {{ min }} et {{ max }} ",
     * )
     */
     
    private $maxPrice;

    

    public function getMaxPrice (): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    public function setMinSurface(int $minSurface): self
    {
        $this->minSurface = $minSurface;

        return $this;
    }
}
