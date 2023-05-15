<?php

namespace App\DataFixtures;

use App\DataFixtures\RoleFixtures;
use App\Entity\Employee;
use App\Repository\RoleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EmployeeFixtures extends Fixture implements DependentFixtureInterface
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository){
        $this->roleRepository = $roleRepository;   
    }

    public function load(ObjectManager $manager): void
    {
        $employee = new Employee();
        $employee->setFirstName('Juan');
        $employee->setLastName('Chofer Ramirez');
        $employee->setRole($this->roleRepository->findOneBy(['name' => 'Chofer']));
        $manager->persist($employee);
        $manager->flush();

        $employee = new Employee();
        $employee->setFirstName('Raul');
        $employee->setLastName('Cargador Perez');
        $employee->setRole($this->roleRepository->findOneBy(['name' => 'Cargador']));
        $manager->persist($employee);
        $manager->flush();

        $employee = new Employee();
        $employee->setFirstName('José');
        $employee->setLastName('Auxiliar Martinez');
        $employee->setRole($this->roleRepository->findOneBy(['name' => 'Auxiliar']));
        $manager->persist($employee);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RoleFixtures::class,
        ];
    }
}
