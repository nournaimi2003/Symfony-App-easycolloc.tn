<?php 
namespace App\Entity; 
use Doctrine\ORM\Mapping as ORM; 
 
class RegionSearch 
{ 
    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\Region") 
     */ 
    private $region; 
 
    public function getRegion(): ?Region 
    { 
        return $this->region; 
    } 
 
    public function setRegion(?Region $region): self 
    { 
        $this->region = $region; 
 
        return $this; 
    } 
} 