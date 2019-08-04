<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\BusStation;

class DefaultUserCreatorBusStationSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
             'prePersist'
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
       
        $entity = $args->getObject();
        if (!$entity instanceof BusStation) {
            return;
        }

        $entity->setCreatedBy(1); 
    }
   
}
