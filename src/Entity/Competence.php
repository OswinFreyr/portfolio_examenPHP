<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    public $nom;

    #[ORM\Column(type: 'integer')]
    public $niveau;

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

    public function getNiveau(){
        return $this->niveau;
    }

    public function setNiveau($niveau){
        $this->niveau = $niveau;
    }

}
