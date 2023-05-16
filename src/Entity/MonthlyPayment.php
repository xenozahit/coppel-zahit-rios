<?php

namespace App\Entity;

use App\Repository\MonthlyPaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonthlyPaymentRepository::class)]
class MonthlyPayment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $month = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?float $baseSalary = null;

    #[ORM\Column]
    private ?int $hourlyBondQuanity = null;

    #[ORM\Column]
    private ?float $hourlyBondMoney = null;

    #[ORM\Column]
    private ?int $deliveryBondQuantity = null;

    #[ORM\Column]
    private ?float $deliveryBondMoney = null;

    #[ORM\Column]
    private ?int $isrTaxRetentionPercentage = null;

    #[ORM\Column]
    private ?float $isrTaxRetentionMoney = null;

    #[ORM\Column]
    private ?int $foodAllowancePercentage = null;

    #[ORM\Column]
    private ?float $foodAllowanceMoney = null;

    #[ORM\ManyToOne(inversedBy: 'monthlyPayments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $employee = null;

    #[ORM\Column]
    private ?float $totalPayment = null;

    #[ORM\ManyToOne(inversedBy: 'monthlyPayments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createdyBy = null;

    #[ORM\Column]
    private ?float $totalBeforeTaxes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(int $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getBaseSalary(): ?float
    {
        return $this->baseSalary;
    }

    public function setBaseSalary(float $baseSalary): self
    {
        $this->baseSalary = $baseSalary;

        return $this;
    }

    public function getHourlyBondQuanity(): ?int
    {
        return $this->hourlyBondQuanity;
    }

    public function setHourlyBondQuanity(int $hourlyBondQuanity): self
    {
        $this->hourlyBondQuanity = $hourlyBondQuanity;

        return $this;
    }

    public function getHourlyBondMoney(): ?float
    {
        return $this->hourlyBondMoney;
    }

    public function setHourlyBondMoney(float $hourlyBondMoney): self
    {
        $this->hourlyBondMoney = $hourlyBondMoney;

        return $this;
    }

    public function getDeliveryBondQuantity(): ?int
    {
        return $this->deliveryBondQuantity;
    }

    public function setDeliveryBondQuantity(int $deliveryBondQuantity): self
    {
        $this->deliveryBondQuantity = $deliveryBondQuantity;

        return $this;
    }

    public function getDeliveryBondMoney(): ?float
    {
        return $this->deliveryBondMoney;
    }

    public function setDeliveryBondMoney(float $deliveryBondMoney): self
    {
        $this->deliveryBondMoney = $deliveryBondMoney;

        return $this;
    }

    public function getIsrTaxRetentionPercentage(): ?int
    {
        return $this->isrTaxRetentionPercentage;
    }

    public function setIsrTaxRetentionPercentage(int $isrTaxRetentionPercentage): self
    {
        $this->isrTaxRetentionPercentage = $isrTaxRetentionPercentage;

        return $this;
    }

    public function getIsrTaxRetentionMoney(): ?float
    {
        return $this->isrTaxRetentionMoney;
    }

    public function setIsrTaxRetentionMoney(float $isrTaxRetentionMoney): self
    {
        $this->isrTaxRetentionMoney = $isrTaxRetentionMoney;

        return $this;
    }

    public function getFoodAllowancePercentage(): ?int
    {
        return $this->foodAllowancePercentage;
    }

    public function setFoodAllowancePercentage(int $foodAllowancePercentage): self
    {
        $this->foodAllowancePercentage = $foodAllowancePercentage;

        return $this;
    }

    public function getFoodAllowanceMoney(): ?float
    {
        return $this->foodAllowanceMoney;
    }

    public function setFoodAllowanceMoney(float $foodAllowanceMoney): self
    {
        $this->foodAllowanceMoney = $foodAllowanceMoney;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function __toString()
    {
        return $this->getEmployee();
    }

    public function getTotalPayment(): ?float
    {
        return $this->totalPayment;
    }

    public function setTotalPayment(float $totalPayment): self
    {
        $this->totalPayment = $totalPayment;

        return $this;
    }

    public function getCreatedyBy(): ?User
    {
        return $this->createdyBy;
    }

    public function setCreatedyBy(?User $createdyBy): self
    {
        $this->createdyBy = $createdyBy;

        return $this;
    }

    public function getTotalBeforeTaxes(): ?float
    {
        return $this->totalBeforeTaxes;
    }

    public function setTotalBeforeTaxes(float $totalBeforeTaxes): self
    {
        $this->totalBeforeTaxes = $totalBeforeTaxes;

        return $this;
    }
}
