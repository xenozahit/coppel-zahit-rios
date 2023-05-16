<?php

namespace App\Controller\Admin;

use App\Entity\Role;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RoleCrudController extends AbstractCrudController
{   
    public static function getEntityFqcn(): string
    {
        return Role::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud        
            ->setEntityLabelInSingular('Rol')
            ->setEntityLabelInPlural('Roles')
            ->setSearchFields(['name'])
            ->showEntityActionsInlined()
            ->setPageTitle(
                "detail",
                fn(Role $role) => (string) $role
            )
            ->setPageTitle(
                "edit",
                fn(Role $role) => (string) $role
            );
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::DELETE);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Rol')
            ->setSortable(true)
            ->setColumns(4),

            MoneyField::new('dailyBaseSalary', 'Salario base por hora')            
            ->setSortable(true)
            ->setColumns(4)
            ->setCurrency('MXN')            
            ->setStoredAsCents(false),            

            MoneyField::new('monthlyBaseSalary', 'Salario base mensual')
            ->setHelp('Este campo se calcula de forma automática')
            ->setSortable(true)
            ->setColumns(4)
            ->setCurrency('MXN')
            ->setFormTypeOption('disabled','disabled')
            ->setStoredAsCents(false),

            MoneyField::new('hourlyBond', 'Bono por hora')
            ->setSortable(true)
            ->setColumns(4)
            ->setCurrency('MXN')
            ->setStoredAsCents(false),

            MoneyField::new('deliveryBond', 'Bono por entrega')
            ->setSortable(true)
            ->setColumns(4)
            ->setCurrency('MXN')
            ->setStoredAsCents(false),

            PercentField::new('foodAllowancePercentage', 'Vales de comida')
            ->setHelp('Del salario mensual')
            ->setStoredAsFractional(false)
            ->setNumDecimals(2)
            ->setSortable(true)
            ->setColumns(4),
            
            IntegerField::new('workDayDuration', 'Jornada laboral (hrs.)')
            ->setSortable(true)
            ->setColumns(4),

            IntegerField::new('workDaysPerWeek', 'Días por semana')
            ->setSortable(true)
            ->setColumns(4),
        ];
    }

    public function configureFilters(Filters $filters): Filters{
        return $filters
            ->add('name')
            ->add('dailyBaseSalary')
            ->add('monthlyBaseSalary')
            ->add('hourlyBond')
            ->add('deliveryBond')
            ->add('foodAllowancePercentage')            
            ->add('workDayDuration')
            ->add('workDaysPerWeek');
    }  
}
