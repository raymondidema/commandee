<?php namespace Raymondidema\Commandee;

use Illuminate\Foundation\Application;

class BaseCommandBus implements CommandBus
{

    protected $app;

    protected $commandTranslator;

    function __construct(Application $app, CommandTranslator $commandTranslator)
    {
        $this->commandTranslator = $commandTranslator;
        $this->app = $app;
    }


    public function execute($command)
    {
        $handler = $this->commandTranslator->toCommandHandler($command);

        return $this->app->make($handler)->handle($command);
    }

} 