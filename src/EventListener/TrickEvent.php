<?php 

namespace App\EventListener;

use App\Entity\Tricks;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\AsciiSlugger;

class TrickEvent implements EventSubscriber
{
    public function getSubscribedEvents():array
    {
        return[
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args):void
    {
        $this->persistTrick($args);
        $this->saveTrick($args);
    }

    public function preUpdate(LifecycleEventArgs $args):void
    {
        $this->saveTrick($args);
    }

    private function persistTrick(LifecycleEventArgs $args):void
    {
        $entity = $args->getObject();
        $slugger = new AsciiSlugger();
        if(!$entity instanceof Tricks) return;

        $entity
                ->setCreatedAt(new \DateTimeImmutable())
                ->setSlug($slugger->slug($entity->getName()));
    }
    private function saveTrick(LifecycleEventArgs $args):void
    {   
        $entity = $args->getObject();

        if (!$entity instanceof Tricks) return;

        $args->getObject()->setUpdatedAt(new \DateTimeImmutable());
    }

    
}   