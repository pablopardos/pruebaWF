<?php

namespace App\Entity;

use App\Repository\OpinionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OpinionRepository::class)
 */
class Opinion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Publicacion::class, inversedBy="opinions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $publicacion_id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="opinions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $op;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPublicacionId(): ?Publicacion
    {
        return $this->publicacion_id;
    }

    public function setPublicacionId(?Publicacion $publicacion_id): self
    {
        $this->publicacion_id = $publicacion_id;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getOp(): ?string
    {
        return $this->op;
    }

    public function setOp(string $op): self
    {
        $this->op = $op;
        
        return $this;
    }

        

}
