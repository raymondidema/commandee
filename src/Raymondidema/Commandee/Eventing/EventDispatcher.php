<?php namespace Raymondidema\Commandee\Eventing;

use Illuminate\Events\Dispatcher;
use Illuminate\Log\Writer;

class EventDispatcher {

    /**
     * @var
     */
    protected $event;

    /**
     * @var
     */
    protected $log;

    /**
     * @param Dispatcher $event
     * @param Writer     $log
     */
    function __construct(Dispatcher $event, Writer $log)
    {
        $this->event = $event;
        $this->log = $log;
    }

    /**
     * @param array $events
     */
    public function dispatch(array $events)
    {
        foreach($events as $event)
        {
            $eventName = $this->getEventName($event);

            $this->event->fire($eventName, $event);

            $this->log->info("$eventName was fired.");
        }
    }

    /**
     * @param $event
     *
     * @return mixed
     */
    protected function getEventName($event)
    {
        return str_replace('\\', '.', get_class($event));
    }

} 