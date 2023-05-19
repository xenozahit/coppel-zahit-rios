<?php

namespace App\Controller;

use DateTime;
use App\Entity\MonthlyPayment;
use App\Repository\RecordRepository;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MonthlyPaymentRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\Admin\RecordCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MonthlyPaymentController extends AbstractController
{
    public function __construct(
        private RecordRepository $recordRepository, 
        private EmployeeRepository $employeeRepository, 
        private MonthlyPaymentRepository $monthlyPaymentRepository, 
        private TokenStorageInterface $tokenStorageInterface,
        private EntityManagerInterface $entityManagerInterface,
        private AdminUrlGenerator $adminUrlGenerator
    ){}

    #[Route('/monthly/calculate-payment', name: 'calculatePayment')]
    public function index(Request $request): Response
    {
        $month = $_GET['month'];
        $year = $_GET['year'];
        $employee = $this->employeeRepository->find($_GET['employee']);
        $startDate = new DateTime($year.'-'.$month.'-01');
        $endDate = new DateTime( date("Y-m-t", strtotime($startDate->format('Y-m-01'))) );

        $totalDeliveries = $this->recordRepository->totalDeliveriesByDatesAndEmployee($startDate, $endDate, $employee);

        $monthlyPayment = $this->monthlyPaymentRepository->findOneBy([
            'month' => $month,
            'year' => $year,
            'employee' => $employee,
        ]);
        if(empty($monthlyPayment)){
            $monthlyPayment = new MonthlyPayment;
            $monthlyPayment->setMonth($month)->setYear($year)->setEmployee($employee);
        }
        
        $monthlyPayment->computeMonthlyPayment($totalDeliveries, $this->tokenStorageInterface);
        $this->entityManagerInterface->persist($monthlyPayment);
        $this->entityManagerInterface->flush();
        
        return $this->redirect($this->adminUrlGenerator->setController(RecordCrudController::class)->generateUrl());
    }
}
