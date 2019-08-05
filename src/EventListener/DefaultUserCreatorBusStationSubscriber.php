<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\BusStation;

class DefaultUserCreatorBusStationSubscriber implements EventSubscriber
{
    /**
     * @var created_by
     */
    private $created_by;

    public function __construct($created_by)
    {
        $this->created_by = $created_by;
    }
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

        $entity->setCreatedBy((int) $this->created_by)
               ->setOnRead(false); 
    }
   
}
