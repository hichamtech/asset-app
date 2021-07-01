<?php

namespace App\Entity;

use App\Repository\WithdrawRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WithdrawRepository::class)
 */
class Withdraw
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\Negative
     */
    private $amount;

    /**
     * @ORM\Column(type="date")
     */
    private $withdrewAt;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="withraws")
     */
    private $account;

    /**
     * @ORM\ManyToOne(targetEntity=Partner::class, inversedBy="withdraws")
     */
    private $partner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getWithdrewAt(): ?\DateTimeInterface
    {
        return $this->withdrewAt;
    }

    public function setWithdrewAt(\DateTimeInterface $withdrewAt): self
    {
        $this->withdrewAt = $withdrewAt;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(?Partner $partner): self
    {
        $this->partner = $partner;

        return $this;
    }
}
