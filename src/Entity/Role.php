<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{

    const WEEKS_PER_MONTH = 4;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $dailyBaseSalary = null;

    #[ORM\Column]
    private ?int $workDayDuration = null;

    #[ORM\Column]
    private ?int $workDaysPerWeek = null;

    #[ORM\Column]
    private ?int $foodAllowancePercentage = null;

    #[ORM\Column]
    private ?float $monthlyBaseSalary = null;

    #[ORM\Column]
    private ?float $hourlyBond = null;

    #[ORM\Column]
    private ?float $deliveryBond = null;

    #[ORM\OneToMany(mappedBy: 'role', targetEntity: Employee::class, orphanRemoval: true)]
    private Collection $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDailyBaseSalary(): ?float
    {
        return $this->dailyBaseSalary;
    }

    public function setDailyBaseSalary(float $dailyBaseSalary): self
    {
        $this->dailyBaseSalary = $dailyBaseSalary;

        return $this;
    }

    public function getWorkDayDuration(): ?int
    {
        return $this->workDayDuration;
    }

    public function setWorkDayDuration(int $workDayDuration): self
    {
        $this->workDayDuration = $workDayDuration;

        return $this;
    }

    public function getWorkDaysPerWeek(): ?int
    {
        return $this->workDaysPerWeek;
    }

    public function setWorkDaysPerWeek(int $workDaysPerWeek): self
    {
        $this->workDaysPerWeek = $workDaysPerWeek;

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

    public function getMonthlyBaseSalary(): ?float
    {
        return $this->monthlyBaseSalary;
    }

    public function setMonthlyBaseSalary(float $monthlyBaseSalary): self
    {
        $this->monthlyBaseSalary = $monthlyBaseSalary;

        return $this;
    }

    public function getHourlyBond(): ?float
    {
        return $this->hourlyBond;
    }

    public function setHourlyBond(float $hourlyBond): self
    {
        $this->hourlyBond = $hourlyBond;

        return $this;
    }

    public function getDeliveryBond(): ?float
    {
        return $this->deliveryBond;
    }

    public function setDeliveryBond(float $deliveryBond): self
    {
        $this->deliveryBond = $deliveryBond;

        return $this;
    }

    public function calculateMonthlyBaseSalary(){
        $this->setMonthlyBaseSalary($this->dailyBaseSalary * $this->workDayDuration * $this->workDaysPerWeek * self::WEEKS_PER_MONTH);
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployee(Employee $employee): self
    {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->setRole($this);
        }

        return $this;
    }

    public function removeEmployee(Employee $employee): self
    {
        if ($this->employees->removeElement($employee)) {
            // set the owning side to null (unless already changed)
            if ($employee->getRole() === $this) {
                $employee->setRole(null);
            }
        }

        return $this;
    }
}
