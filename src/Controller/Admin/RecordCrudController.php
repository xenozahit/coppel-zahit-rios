<?php

namespace App\Controller\Admin;

use App\Entity\Record;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RecordCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Record::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud        
            ->setEntityLabelInSingular('Registro de entrega')
            ->setEntityLabelInPlural('Registro de entregas')
            ->setSearchFields(['date', 'employee'])
            ->showEntityActionsInlined()
            ->setPageTitle(
                "detail",
                fn(Record $record) => (string) $record
            )
            ->setPageTitle(
                "edit",
                fn(Record $record) => (string) $record
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
            DateField::new('date', 'Fecha')->setColumns(4),
            FormField::addRow(),
            IntegerField::new('quantity', 'Cantidad')->setColumns(4),
            AssociationField::new('employee', 'Empleado')->setColumns(4)
        ];
    }

    public function configureFilters(Filters $filters): Filters{
        return $filters
            ->add('date')
            ->add('quantity')
            ->add('employee');
    }
}
