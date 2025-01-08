<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $motDePasse;

    #[ORM\OneToOne(mappedBy: 'utilisateur', targetEntity: Profil::class)]
    private $profil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom (){
        return $this->nom;
    }

    public function setNom ($nom){
        $this->nom = $nom;
    }
    
    public function getEmail (){
        return $this->email;
    }

    public function setEmail ($email){
        $this->email = $email;
    }

    public function getMotDePasse (){
        return $this->motDePasse;
    }

    public function setMotDePasse ($motDePasse){
        $this->motDePasse = $motDePasse;
    }

    public function getProfil ():?Profil{
        return $this->profil;
    }

    public function setProfil (Profil $profil): self{
        $this->profil = $profil;
        $profil->setUtilisateur($this);
        return $this;
    }
}
