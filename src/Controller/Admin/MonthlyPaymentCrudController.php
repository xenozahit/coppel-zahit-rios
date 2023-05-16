<?php

namespace App\Controller\Admin;

use App\Entity\MonthlyPayment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class MonthlyPaymentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MonthlyPayment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud        
            ->setEntityLabelInSingular('Pago mensual')
            ->setEntityLabelInPlural('Pagos mensuales')
            //->setSearchFields(['firstName', 'lastName', 'role'])
            ->showEntityActionsInlined()
            ->setPageTitle(
                "detail",
                fn(MonthlyPayment $monthlyPayment) => (string) $monthlyPayment
            )
            ->setPageTitle(
                "edit",
                fn(MonthlyPayment $monthlyPayment) => (string) $monthlyPayment
            );
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fa fa-file-alt')->setLabel('Ver detalle');
            })
            ->disable(Action::DELETE, Action::NEW, Action::EDIT);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('employee', 'Empleado')
            ->setSortable(true),

            IntegerField::new('month', 'Mes')
            ->setNumberFormat('%.0d')
            ->setSortable(true),

            IntegerField::new('year', 'Año')
            ->setNumberFormat('%.0d')
            ->setSortable(true),

            MoneyField::new('baseSalary', 'Salario base mensual')            
            ->setSortable(true)
            ->setCurrency('MXN')
            ->setStoredAsCents(false),

            NumberField::new('hourlyBondQuanity', 'Horas bonificadas')
            ->hideOnIndex()
            ->setSortable(true)
            ->setNumDecimals(0),

            MoneyField::new('hourlyBondMoney', 'Horas bonificadas ($)')
            ->setSortable(true)
            ->setCurrency('MXN')
            ->setStoredAsCents(false),

            NumberField::new('deliveryBondQuantity', 'Entregas')
            ->hideOnIndex()
            ->setSortable(true)
            ->setNumDecimals(0),

            MoneyField::new('deliveryBondMoney', 'Entregas ($)')
            ->setSortable(true)
            ->setCurrency('MXN')
            ->setStoredAsCents(false),

            MoneyField::new('totalBeforeTaxes', 'Total Deducciones ($)')
            ->setSortable(true)
            ->setCurrency('MXN')
            ->setStoredAsCents(false),
            
            NumberField::new('isrTaxRetentionPercentage', 'ISR (%)')
            ->hideOnIndex()
            ->setSortable(true)            
            ->setNumDecimals(0),

            MoneyField::new('isrTaxRetentionMoney', 'ISR ($)')
            ->setSortable(true)
            ->setCurrency('MXN')
            ->setStoredAsCents(false),

            MoneyField::new('totalPayment', 'Sueldo neto ($)')
            ->setSortable(true)
            ->setCurrency('MXN')
            ->setStoredAsCents(false),

            NumberField::new('foodAllowancePercentage', 'Vales despensa(%)')
            ->hideOnIndex()
            ->setSortable(true)            
            ->setNumDecimals(0),

            MoneyField::new('foodAllowanceMoney', 'Vales despensa ($)')
            ->setSortable(true)
            ->setCurrency('MXN')
            ->setStoredAsCents(false),

            AssociationField::new('createdyBy', 'Registró')
            ->setSortable(true),
        ];
    }

    // public function configureFilters(Filters $filters): Filters{
    //     return $filters
    //         ->add('firstName')
    //         ->add('lastName')
    //         ->add('role');
    // }
}
