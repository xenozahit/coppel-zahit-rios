<?php

namespace App\EventSubscriber;

use App\Entity\Role;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class AdminSubscriber implements EventSubscriberInterface
{
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

        if ($entity instanceof Role){
            $entity->calculateMonthlyBaseSalary();
        }        
    }

    public function beforPersistEntity(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Role){
            $entity->calculateMonthlyBaseSalary();
        }        
    }
}