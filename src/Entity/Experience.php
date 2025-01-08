<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class Experience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    public $poste;

    #[ORM\Column(type: 'string', length: 255)]
    public $entreprise;

    #[ORM\Column(type: 'date')]
    public $dateDebut;

    #[ORM\Column(type: 'date', nullable: true)]
    public $dateFin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoste(){
        return $this->poste;
    }

    public function setPoste($poste){
        $this->poste = $poste;
    }


    public function getEntreprise(){
        return $this->entreprise;
    }

    public function setEntreprise($entreprise){
        $this->entreprise = $entreprise;
    }

    public function getDateDebut(){
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut){
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin(){
        return $this->dateFin;
    }

    public function setDateFin($dateFin){
        $this->dateFin = $dateFin;
    }
}
