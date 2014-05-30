<?php namespace Raymondidema\Commandee\Commanding;

use Illuminate\Foundation\Application;

class CommandFactory {

    /**
     * @var CommandTranslator
     */
    protected $commandTranslator;

    /**
     * @var \Illuminate\Foundation\Application
     */
    private $app;

    /**
     * @param Application       $app
     * @param CommandTranslator $commandTranslator
     */
    function __construct(Application $app, CommandTranslator $commandTranslator)
    {
        $this->commandTranslator = $commandTranslator;
        $this->app = $app;
    }

    /**
     * @param $command
     *
     * @return mixed
     */
    public function execute($command)
    {
        // Translate the object name into a handler class
        $handler = $this->commandTranslator->toCommandHandler($command);

        // Resolve it out of the IOC container, and call handle method
        return $this->app->make($handler)->handle($command);
    }

} 