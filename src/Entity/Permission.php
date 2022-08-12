<?php

namespace App\Entity;

use App\Repository\PermissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermissionRepository::class)]
class Permission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $send_newsletter = null;

    #[ORM\Column]
    private ?bool $sell_drink = null;

    #[ORM\Column]
    private ?bool $payment_stats = null;

    #[ORM\Column]
    private ?bool $add_members = null;

    #[ORM\Column]
    private ?bool $recrut_employee = null;

    #[ORM\Column]
    private ?bool $activated_website = null;

    #[ORM\Column]
    private ?bool $place_search = null;

    #[ORM\Column]
    private ?bool $restaurant_site = null;

    #[ORM\Column]
    private ?bool $renovation = null;

    #[ORM\Column]
    private ?bool $available_coach = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\ManyToOne(inversedBy: 'permissions')]
    private ?Structure $branch_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isSendNewsletter(): ?bool
    {
        return $this->send_newsletter;
    }

    public function setSendNewsletter(bool $send_newsletter): self
    {
        $this->send_newsletter = $send_newsletter;

        return $this;
    }

    public function isSellDrink(): ?bool
    {
        return $this->sell_drink;
    }

    public function setSellDrink(bool $sell_drink): self
    {
        $this->sell_drink = $sell_drink;

        return $this;
    }

    public function isPaymentStats(): ?bool
    {
        return $this->payment_stats;
    }

    public function setPaymentStats(bool $payment_stats): self
    {
        $this->payment_stats = $payment_stats;

        return $this;
    }

    public function isAddMembers(): ?bool
    {
        return $this->add_members;
    }

    public function setAddMembers(bool $add_members): self
    {
        $this->add_members = $add_members;

        return $this;
    }

    public function isRecrutEmployee(): ?bool
    {
        return $this->recrut_employee;
    }

    public function setRecrutEmployee(bool $recrut_employee): self
    {
        $this->recrut_employee = $recrut_employee;

        return $this;
    }

    public function isActivatedWebsite(): ?bool
    {
        return $this->activated_website;
    }

    public function setActivatedWebsite(bool $activated_website): self
    {
        $this->activated_website = $activated_website;

        return $this;
    }

    public function isPlaceSearch(): ?bool
    {
        return $this->place_search;
    }

    public function setPlaceSearch(bool $place_search): self
    {
        $this->place_search = $place_search;

        return $this;
    }

    public function isRestaurantSite(): ?bool
    {
        return $this->restaurant_site;
    }

    public function setRestaurantSite(bool $restaurant_site): self
    {
        $this->restaurant_site = $restaurant_site;

        return $this;
    }

    public function isRenovation(): ?bool
    {
        return $this->renovation;
    }

    public function setRenovation(bool $renovation): self
    {
        $this->renovation = $renovation;

        return $this;
    }

    public function isAvailableCoach(): ?bool
    {
        return $this->available_coach;
    }

    public function setAvailableCoach(bool $available_coach): self
    {
        $this->available_coach = $available_coach;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getBranchId(): ?Structure
    {
        return $this->branch_id;
    }

    public function setBranchId(?Structure $branch_id): self
    {
        $this->branch_id = $branch_id;

        return $this;
    }
}
