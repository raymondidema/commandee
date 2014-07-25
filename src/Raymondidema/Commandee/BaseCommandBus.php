<?php namespace Raymondidema\Commandee;

use Illuminate\Foundation\Application;
use Psr\Log\InvalidArgumentException;

class BaseCommandBus implements CommandBus
{

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @var CommandTranslator
     */
    protected $commandTranslator;

    /**
     * @var array
     */
    protected $decorators = [];

    /**
     * @param \Illuminate\Foundation\Application            $app
     * @param \Raymondidema\Commandee\BaseCommandTranslator $commandTranslator
     */
    function __construct(Application $app, BaseCommandTranslator $commandTranslator)
    {
        $this->app = $app;
        $this->commandTranslator = $commandTranslator;
    }

    /**
     * @param $className
     */
    public function decorate($className)
    {
        $this->decorators[] = $className;
    }


    /**
     * @param $command
     *
     * @return mixed
     */
    public function execute($command)
    {
        $this->executeDecorators($command);

        $handler = $this->commandTranslator->toCommandHandler($command);

        return $this->app->make($handler)->handle($command);
    }

    /**
     * @param $command
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    protected function executeDecorators($command)
    {
        foreach ($this->decorators as $className)
        {
            $instance = $this->app->make($className);

            if ( ! $instance instanceof CommandBus)
            {
                $message = 'The class to decorate must be an implementation of Raymondidema\Commandee\CommandBus';
                throw new InvalidArgumentException($message);
            }

            $instance->execute($command);
        }
    }

} 