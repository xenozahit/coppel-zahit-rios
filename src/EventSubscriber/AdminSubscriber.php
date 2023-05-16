<?php

namespace App\EventSubscriber;

use App\Entity\Role;
use App\Entity\Record;
use App\Repository\RecordRepository;
use App\Controller\MonthlyPaymentUpdate;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MonthlyPaymentRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AdminSubscriber implements EventSubscriberInterface
{

    private MonthlyPaymentRepository $monthlyPaymentRepository;
    private RecordRepository $recordRepository;
    private EntityManagerInterface $manager;
    private TokenStorageInterface $tokenStorage;

    public function __construct(MonthlyPaymentRepository $monthlyPaymentRepository, RecordRepository $recordRepository, EntityManagerInterface $manager, TokenStorageInterface $tokenStorage)
    {
        $this->monthlyPaymentRepository = $monthlyPaymentRepository;
        $this->recordRepository = $recordRepository;
        $this->manager = $manager;
        $this->tokenStorage = $tokenStorage;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['beforPersistEntity'],
            BeforeEntityUpdatedEvent::class => ['beforeUpdateEntity'],
            AfterEntityPersistedEvent::class => ['afterEntityPersistedEvent'],
            AfterEntityUpdatedEvent::class => ['afterEntityUpdatedEvent'],
        ];
    }

    public function afterEntityUpdatedEvent(AfterEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Record)
            $this->recordActions($entity);
    }

    public function afterEntityPersistedEvent(AfterEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Record)
            $this->recordActions($entity);
    }

    public function beforeUpdateEntity(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Role)
            $this->roleActions($entity);
    }

    public function beforPersistEntity(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Role)
            $this->roleActions($entity);   
    }

    public function roleActions(Role $role)
    {
        $role->calculateMonthlyBaseSalary();
    }

    public function recordActions(Record $record)
    {
        MonthlyPaymentUpdate::calculatePayment($record, $this->monthlyPaymentRepository, $this->recordRepository, $this->manager, $this->tokenStorage);
    }
    
}
