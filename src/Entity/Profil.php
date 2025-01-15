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

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    public function setRoles($roles): void{
        $this->roles = $roles;
        array_push($this->roles, 'ROLE_ADMIN');
    }

    public function getRoles(): mixed
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        // $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

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
