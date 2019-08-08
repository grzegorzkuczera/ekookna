<?php

namespace App\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\File;
use App\Service\FileUploader; 

class RemoveUploadFilesSubscriber implements EventSubscriber
{
 
    private $file;

    public function __construct(FileUploader $file)
    {
        $this->file= $file;
    }

    public function getSubscribedEvents()
    {
        return [
             'postRemove'
        ];
    }

    public function postRemove(LifecycleEventArgs $args)
    {
       
        $entity = $args->getObject();
        if (!$entity instanceof File) {
            return;
        }

        $fileName = $entity->getFileName();
        $this->file->removeFile($fileName);

    }
   
}
