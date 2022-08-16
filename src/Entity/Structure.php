<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: StructureRepository::class)]
class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?int $install_id = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    private ?Partenaire $client_id = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\OneToMany(mappedBy: 'branch_id', targetEntity: Permission::class)]
    private Collection $permissions;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\Image(
        minWidth: 200,
        maxWidth: 1200,
        maxHeight: 1200,
        minHeight: 200,
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoStructure = null;

    public function __construct()
    {
        $this->permissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getInstallId(): ?int
    {
        return $this->install_id;
    }

    public function setInstallId(?int $install_id): self
    {
        $this->install_id = $install_id;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getClientId(): ?Partenaire
    {
        return $this->client_id;
    }

    public function setClientId(?Partenaire $client_id): self
    {
        $this->client_id = $client_id;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, Permission>
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    public function addPermission(Permission $permission): self
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
            $permission->setBranchId($this);
        }

        return $this;
    }

    public function removePermission(Permission $permission): self
    {
        if ($this->permissions->removeElement($permission)) {
            // set the owning side to null (unless already changed)
            if ($permission->getBranchId() === $this) {
                $permission->setBranchId(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLogoStructure(): ?string
    {
        return $this->logoStructure;
    }

    public function setLogoStructure(?string $logoStructure): self
    {
        $this->logoStructure = $logoStructure;

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }

}
