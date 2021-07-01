<?php

namespace App\Entity;

use App\Repository\DepositRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepositRepository::class)
 */
class Deposit
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
    private $amount;

    /**
     * @ORM\Column(type="date")
     */
    private $depositedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Account::class, inversedBy="deposit")
     */
    private $account;

    /**
     * @ORM\ManyToOne(targetEntity=Partner::class, inversedBy="deposits")
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

    public function getDepositedAt(): ?\DateTimeInterface
    {
        return $this->depositedAt;
    }

    public function setDepositedAt(\DateTimeInterface $depositedAt): self
    {
        $this->depositedAt = $depositedAt;

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
