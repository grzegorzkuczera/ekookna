<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Repository\BusStationRepository;
use App\Entity\BusStation;
use Doctrine\ORM\EntityManagerInterface;

class OnReadFlagSubscriber implements EventSubscriberInterface
{
     /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * $var BusStationRepository
     */
    private $busStationRepository;

    public function __construct(       
        EntityManagerInterface $entityManager,
        BusStationRepository $busStationRepository
    ) {    
        $this->entityManager = $entityManager;  
        $this->busStationRepository = $busStationRepository;
    }

    public function setFlagOnRead(ResponseEvent $event)
    {
    
        $route = $event->getRequest()->attributes->get('_route');
        $param = $event->getRequest()->attributes->get('id');
        $status = $event->getResponse()->isOk();

        if ($route !== 'edit_index' || empty($param) || !$status ) {
            return;
        }
        
        $repository = $this->busStationRepository;
        $busStation = $repository->find($param);
        $busStation->setOnRead(true);

        
        $this->entityManager->persist($busStation);
        $this->entityManager->flush();
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => 'setFlagOnRead',
        ];
    }
}
