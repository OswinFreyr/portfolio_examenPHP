<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Technologie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\ManyToMany(mappedBy: 'technologies', targetEntity: Projet::class)]
    private $projets;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNom(){
        return $this->nom;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function getProjets(){
        return $this->projets;
    }

    public function setProjets($projets){
        $this->projets = $projets;
    }
}
