<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\PersistentCollection;
use App\Entity\SlugifyInterface;
use Cocur\Slugify\Slugify;

class SlugifySubscriber implements EventSubscriber
{
 
    public function getSubscribedEvents()
    {
        return [
            Events::onFlush,
        ];
    }

  
    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        /** @var PersistentCollection $collectionInsert*/
        foreach ($uow->getScheduledEntityInsertions() as $collectionInsert) {
            if (!$collectionInsert instanceof SlugifyInterface) {
                continue;
            }
            $fields = $collectionInsert->getSlugFields();
            if (empty($fields)) {
                return;
            }

            $value = implode('-', array_map(function($property) use($collectionInsert) {
               return $collectionInsert->{'get'.ucfirst($property)}();     
            }, $fields));          

            $slugify = new Slugify();

            $slug = $slugify->slugify($value);
            $collectionInsert->setSlug($slug);
            $em->persist($collectionInsert);

            $classMetadata = $em->getClassMetadata(get_class($collectionInsert));
            $uow->recomputeSingleEntityChangeSet($classMetadata,  $collectionInsert);
                       
        }
    }
    
}
