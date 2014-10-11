<?php namespace Raymondidema\Commandee\Events;

use Illuminate\Events\Dispatcher;
use Illuminate\Log\Writer;

class EventDispatcher {

    protected $event;
    protected $log;

    function __construct(Dispatcher $event, Writer $log)
    {
        $this->event = $event;
        $this->log = $log;
    }


    public function dispatch(array $events, $legacy = true)
    {
        foreach($events as $event)
        {
            $eventName = $this->getEventName($event, $legacy);
            $this->event->fire($eventName, $event);
            $this->log->info("$eventName was fired.");
        }
    }

    /**
     * Get Event Name, use Legacy if we want to use it in Laravel 4
     * else we can use it in Laravel 5
     *
     * @param $event
     * @return mixed
     */
    protected function getEventName($event, $legacy)
    {
        if($legacy)
            return str_replace('\\', '.', get_class($event));
        $data = explode('\\', get_class($event));
        return end($data);

    }
}