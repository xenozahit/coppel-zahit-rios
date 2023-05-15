<?php

namespace App\Controller\Admin;

use App\Entity\Employee;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EmployeeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employee::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud        
            ->setEntityLabelInSingular('Empleado')
            ->setEntityLabelInPlural('Empleados')
            ->setSearchFields(['firstName', 'lastName', 'role'])
            ->showEntityActionsInlined()
            ->setPageTitle(
                "detail",
                fn(Employee $employee) => (string) $employee
            )
            ->setPageTitle(
                "edit",
                fn(Employee $employee) => (string) $employee
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
            TextField::new('firstName', 'Nombre(s)')
            ->setSortable(true)
            ->setColumns(4),

            TextField::new('lastName', 'Apellidos')
            ->setSortable(true)
            ->setColumns(4),

            AssociationField::new('role', 'Rol')
            ->autocomplete()
            ->setColumns(4),
        ];
    }

    public function configureFilters(Filters $filters): Filters{
        return $filters
            ->add('firstName')
            ->add('lastName')
            ->add('role');
    }
}
