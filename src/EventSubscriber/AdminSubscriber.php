<?php

namespace App\EventSubscriber;

use App\Entity\Role;
use App\Entity\Record;
use App\Repository\RecordRepository;
use App\Controller\MonthlyPaymentUpdate;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MonthlyPaymentRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class AdminSubscriber implements EventSubscriberInterface
{

    private MonthlyPaymentRepository $monthlyPaymentRepository;
    private RecordRepository $recordRepository;
    private EntityManagerInterface $manager;

    public function __construct(MonthlyPaymentRepository $monthlyPaymentRepository, RecordRepository $recordRepository, EntityManagerInterface $manager)
    {
        $this->monthlyPaymentRepository = $monthlyPaymentRepository;
        $this->recordRepository = $recordRepository;
        $this->manager = $manager;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['beforPersistEntity'],
            BeforeEntityUpdatedEvent::class => ['beforeUpdateEntity'],
        ];
    }

    public function beforeUpdateEntity(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Role)
            $this->roleActions($entity);

        if ($entity instanceof Record)
            $this->recordActions($entity);

    }

    public function beforPersistEntity(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Role)
            $this->roleActions($entity);

        if ($entity instanceof Record)
            $this->recordActions($entity);

    }

    public function roleActions(Role $role)
    {
        $role->calculateMonthlyBaseSalary();
    }

    public function recordActions(Record $record)
    {
        MonthlyPaymentUpdate::calculatePayment($record, $this->monthlyPaymentRepository, $this->recordRepository, $this->manager);
    }
}