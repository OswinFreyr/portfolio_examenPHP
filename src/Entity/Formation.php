<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $diplome;

    #[ORM\Column(type: 'string', length: 255)]
    private $etablissement;

    #[ORM\Column(type: 'date')]
    private $dateDebut;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateFin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiplome(){
        return $this->diplome;
    }

    public function setDiplome($diplome){
        $this->diplome = $diplome;
    }

    public function getEtablissement(){
        return $this->etablissement;
    }

    public function setEtablissement($etablissement){
        $this->etablissement = $etablissement;
    }

    public function getDateDebut(){
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut){
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin(){
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin = null){
        $this->dateFin = $dateFin;
    }
}
