<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AccountRepository::class)
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $blance;

    /**
     * @ORM\OneToMany(targetEntity=Withdraw::class, mappedBy="account")
     */
    private $withraws;

    /**
     * @ORM\OneToMany(targetEntity=Deposit::class, mappedBy="account")
     */
    private $deposit;

    /**
     * @ORM\OneToMany(targetEntity=Partner::class, mappedBy="account")
     */
    private $partners;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    public function __construct()
    {
        $this->withraws = new ArrayCollection();
        $this->deposit = new ArrayCollection();
        $this->partners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlance(): ?float
    {
        return $this->blance;
    }

    public function setBlance(float $blance): self
    {
        $this->blance = $blance;

        return $this;
    }

    /**
     * @return Collection|Withdraw[]
     */
    public function getWithraws(): Collection
    {
        return $this->withraws;
    }

    public function addWithraw(Withdraw $withraw): self
    {
        if (!$this->withraws->contains($withraw)) {
            $this->withraws[] = $withraw;
            $withraw->setAccount($this);
        }

        return $this;
    }

    public function removeWithraw(Withdraw $withraw): self
    {
        if ($this->withraws->removeElement($withraw)) {
            // set the owning side to null (unless already changed)
            if ($withraw->getAccount() === $this) {
                $withraw->setAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Deposit[]
     */
    public function getDeposit(): Collection
    {
        return $this->deposit;
    }

    public function addDeposit(Deposit $deposit): self
    {
        if (!$this->deposit->contains($deposit)) {
            $this->deposit[] = $deposit;
            $deposit->setAccount($this);
        }

        return $this;
    }

    public function removeDeposit(Deposit $deposit): self
    {
        if ($this->deposit->removeElement($deposit)) {
            // set the owning side to null (unless already changed)
            if ($deposit->getAccount() === $this) {
                $deposit->setAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Partner[]
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Partner $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners[] = $partner;
            $partner->setAccount($this);
        }

        return $this;
    }

    public function removePartner(Partner $partner): self
    {
        if ($this->partners->removeElement($partner)) {
            // set the owning side to null (unless already changed)
            if ($partner->getAccount() === $this) {
                $partner->setAccount(null);
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

    public function __toString()
    {
        return $this->name;
    }

}
