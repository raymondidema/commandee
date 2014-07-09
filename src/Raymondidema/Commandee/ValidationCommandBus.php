<?php namespace Raymondidema\Commandee;

use Illuminate\Foundation\Application;

class ValidationCommandBus implements CommandBus {

    protected $app;

    protected $commandTranslator;

    protected $commandBus;

    function __construct(BaseCommandBus $commandBus, Application $app, CommandTranslator $commandTranslator)
    {
        $this->commandTranslator = $commandTranslator;
        $this->app = $app;
        $this->commandBus = $commandBus;
    }


    public function execute($command)
    {

        $validator = $this->commandTranslator->toValidator($command);

        if(class_exists($validator))
        {
            $this->app->make($validator)->validate($command);
        }

        return $this->commandBus->execute($command);

    }
} 