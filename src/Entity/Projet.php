<?php 

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lien;

    #[ORM\ManyToMany(targetEntity: Technologie::class, inversedBy: 'projets')]
    private $technologies;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getTitre(){
        return $this->titre;
    }

    public function setTitre($titre){
        $this->titre = $titre;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getLien(){
        return $this->lien;
    }

    public function setLien($lien){
        $this->lien = $lien;
    }

    public function getTechnologies(){
        return $this->technologies;
    }

    public function setTechnologies($technologies){
        $this->technologies = $technologies;
    }
}
