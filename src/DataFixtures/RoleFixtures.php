<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
   
    public function load(ObjectManager $manager): void
    {
        $role = new Role();
        $role->setName('Chofer');
        $role->setDailyBaseSalary(30);
        $role->setWorkDayDuration(8);
        $role->setWorkDaysPerWeek(6);
        $role->setFoodAllowancePercentage(4);        
        $role->setMonthlyBaseSalary(5760);
        $role->setHourlyBond(10);
        $role->setDeliveryBond(5);
        $manager->persist($role);

        $role = new Role();
        $role->setName('Cargador');
        $role->setDailyBaseSalary(30);
        $role->setWorkDayDuration(8);
        $role->setWorkDaysPerWeek(6);
        $role->setFoodAllowancePercentage(4);        
        $role->setMonthlyBaseSalary(5760);
        $role->setHourlyBond(5);
        $role->setDeliveryBond(5);
        $manager->persist($role);

        $role = new Role();
        $role->setName('Auxiliar');
        $role->setDailyBaseSalary(30);
        $role->setWorkDayDuration(8);
        $role->setWorkDaysPerWeek(6);
        $role->setFoodAllowancePercentage(4);        
        $role->setMonthlyBaseSalary(5760);
        $role->setHourlyBond(0);
        $role->setDeliveryBond(5);
        $manager->persist($role);

        $manager->flush();
    }
}
