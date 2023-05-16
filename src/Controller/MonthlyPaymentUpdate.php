<?php

namespace App\Controller;

use DateTime;
use App\Entity\Role;
use App\Entity\Record;
use App\Entity\MonthlyPayment;
use App\Repository\RecordRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MonthlyPaymentRepository;

class MonthlyPaymentUpdate 
{
    const BOND_PER_DELIVERY = 5;
    const HIGHER_ISR_TAX = 12;
    const LOWER_ISR_TAX = 9;
    const MONTHLY_SALARY_LIMIT = 10000;
    const FOOD_ALLOWANCE_PERCENTAGE = 4;

    public static function calculatePayment(Record $record, MonthlyPaymentRepository $monthlyPaymentRepository, RecordRepository $recordRepository, EntityManagerInterface $manager)
    {        
        $role = $record->getEmployee()->getRole();
        $deliveryBondQuantity = 0;
        $deliveryBondMoney = 0;
        $hourlyBondQuanity = 0;
        $hourlyBondMoney = 0;
        $monthlySalary = 0;
        $isrTaxRetentionPercentage = 0;
        $isrTaxRetentionMoney = 0;
        $foodAllowancePercentage = 0;
        $foodAllowanceMoney = 0;        
        $month = date_format($record->getDate(), 'n');
        $year = date_format($record->getDate(), 'Y');
        $startDate = new DateTime($year.'-'.$month.'-01');
        $endDate = new DateTime( date("Y-m-t", strtotime($startDate->format('Y-m-01'))) );

        $monthlyRecords = $recordRepository->findByDatesAndEmployee($startDate, $endDate, $record->getEmployee());        
        
        foreach($monthlyRecords as $monthlyRecord){ //calc of deliveries quantity
            $deliveryBondQuantity += $monthlyRecord->getQuantity();
        }
        $deliveryBondMoney = self::BOND_PER_DELIVERY * $deliveryBondQuantity; //calc of deliveries bond in money

        $hourlyBondQuanity = $role->getDeliveryBond() > 0 ? Role::WEEKS_PER_MONTH * $role->getWorkDayDuration() * $role->getWorkDaysPerWeek()  : 0; //calc of hours bond quantity
        $hourlyBondMoney = $hourlyBondQuanity > 0 ? $hourlyBondQuanity * $role->getDeliveryBond() : 0; //calc of hours bond money
        
        $monthlySalary = $role->getMonthlyBaseSalary() + $deliveryBondMoney + $hourlyBondMoney; //calc of total monthly salary 

        $isrTaxRetentionPercentage = $monthlySalary > self::MONTHLY_SALARY_LIMIT ? self::HIGHER_ISR_TAX : self::LOWER_ISR_TAX; //calc of isr tax retention percentage
        $isrTaxRetentionMoney = $monthlySalary * $isrTaxRetentionPercentage / 100; //calc of isr tax retention money

        $foodAllowancePercentage = self::FOOD_ALLOWANCE_PERCENTAGE;
        $foodAllowanceMoney = $monthlySalary * $foodAllowancePercentage / 100; //calc of food allowance money

        $monthlyPayment = $monthlyPaymentRepository->findOneBy([
            'month' => $month,
            'year' => $year,
            'employee' => $record->getEmployee(),
        ]) ?? new MonthlyPayment;

        $monthlyPayment->setMonth($month);
        $monthlyPayment->setYear($year);
        $monthlyPayment->setBaseSalary($role->getMonthlyBaseSalary());
        $monthlyPayment->setHourlyBondQuanity($hourlyBondQuanity);
        $monthlyPayment->setHourlyBondMoney($hourlyBondMoney);
        $monthlyPayment->setDeliveryBondQuantity($deliveryBondQuantity);
        $monthlyPayment->setDeliveryBondMoney($deliveryBondMoney);
        $monthlyPayment->setIsrTaxRetentionPercentage($isrTaxRetentionPercentage);
        $monthlyPayment->setIsrTaxRetentionMoney($isrTaxRetentionMoney);
        $monthlyPayment->setFoodAllowancePercentage($foodAllowancePercentage);
        $monthlyPayment->setFoodAllowanceMoney($foodAllowanceMoney);
        $monthlyPayment->setEmployee($record->getEmployee());

        $manager->persist($monthlyPayment);
        $manager->flush();
    }

}
