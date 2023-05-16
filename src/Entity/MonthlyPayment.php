<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MonthlyPaymentRepository;

#[ORM\Entity(repositoryClass: MonthlyPaymentRepository::class)]
class MonthlyPayment
{
    const BOND_PER_DELIVERY = 5;
    const HIGHER_ISR_TAX = 12;
    const LOWER_ISR_TAX = 9;
    const MONTHLY_SALARY_LIMIT = 10000;
    const FOOD_ALLOWANCE_PERCENTAGE = 4;

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

    public function calculatePayment(array $records)
    {
        $role = $this->getEmployee()->getRole();
        $deliveryBondQuantity = 0;
        $deliveryBondMoney = 0;
        $hourlyBondQuanity = 0;
        $hourlyBondMoney = 0;
        $monthlySalary = 0;
        $isrTaxRetentionPercentage = 0;
        $isrTaxRetentionMoney = 0;
        $foodAllowancePercentage = 0;
        $foodAllowanceMoney = 0;   
        
        foreach($records as $monthlyRecord){ //calc of deliveries quantity
            $deliveryBondQuantity += $monthlyRecord->getQuantity();
        }
        $deliveryBondMoney = self::BOND_PER_DELIVERY * $deliveryBondQuantity; //calc of deliveries bond in money

        $hourlyBondQuanity = $role->getHourlyBond() > 0 ? Role::WEEKS_PER_MONTH * $role->getWorkDayDuration() * $role->getWorkDaysPerWeek()  : 0; //calc of hours bond quantity
        $hourlyBondMoney = $hourlyBondQuanity > 0 ? $hourlyBondQuanity * $role->getHourlyBond() : 0; //calc of hours bond money

        $monthlySalary = $role->getMonthlyBaseSalary() + $deliveryBondMoney + $hourlyBondMoney; //calc of total monthly salary
        
        $foodAllowancePercentage = self::FOOD_ALLOWANCE_PERCENTAGE;
        $foodAllowanceMoney = $monthlySalary * $foodAllowancePercentage / 100; //calc of food allowance money

        $isrTaxRetentionPercentage = $monthlySalary > self::MONTHLY_SALARY_LIMIT ? self::HIGHER_ISR_TAX : self::LOWER_ISR_TAX; //calc of isr tax retention percentage
        $isrTaxRetentionMoney = $monthlySalary * $isrTaxRetentionPercentage / 100; //calc of isr tax retention money

        $monthlySalaryBeforeTaxes = $monthlySalary;
        $monthlySalary -= $isrTaxRetentionMoney;

        $this->setBaseSalary($role->getMonthlyBaseSalary())
            ->setHourlyBondQuanity($hourlyBondQuanity)
            ->setHourlyBondMoney($hourlyBondMoney)
            ->setDeliveryBondQuantity($deliveryBondQuantity)
            ->setDeliveryBondMoney($deliveryBondMoney)
            ->setIsrTaxRetentionPercentage($isrTaxRetentionPercentage)
            ->setIsrTaxRetentionMoney($isrTaxRetentionMoney)
            ->setFoodAllowancePercentage($foodAllowancePercentage)
            ->setFoodAllowanceMoney($foodAllowanceMoney)
            ->setTotalBeforeTaxes($monthlySalaryBeforeTaxes)
            ->setTotalPayment($monthlySalary);        
    }
}
