<?php namespace Raymondidema\Commandee\Events;

trait DispatchableTrait {

    public function dispatchEventsFor($entity)
    {
        return $this->getDispatcher()->dispatch($entity->releaseEvents());
    }

    public function getDispatcher()
    {
        return App::make('Raymondidema\Commandee\Events\EventDispatcher');
    }
} 