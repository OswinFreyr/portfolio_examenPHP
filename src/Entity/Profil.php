<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Profil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $photo;

    #[ORM\Column(type: 'text', nullable: true)]
    private $bio;

    #[ORM\OneToOne(inversedBy: 'profil', targetEntity: Utilisateur::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getPhoto(){
        return $this->photo;
    }

    public function setPhoto($photo){
        $this->photo = $photo;
    }

    public function getBio(){
        return $this->bio;
    }

    public function setBio($bio){
        $this->bio = $bio;
    }

    
    public function getUtilisateur(){
        return $this->utilisateur;
    }


    public function setUtilisateur(Utilisateur $utilisateur){
        $this->utilisateur = $utilisateur;
    }
}   
