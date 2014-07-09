<?php namespace Raymondidema\Commandee;

class CommandTranslator {

    /**
     * @param $command
     *
     * @return mixed
     * @throws CommandBusException
     */
    public function toCommandHandler($command)
    {
        $commandClass = get_class($command);
        $handler = substr_replace($commandClass, 'CommandHandler', strrpos($commandClass, 'Command'));
        if( ! class_exists($handler))
        {
            $message = "Command handler [$handler] does not exist";
            throw new CommandBusException($message);
        }
        return $handler;
    }

    public  function toValidator($command)
    {
        $commandClass = get_class($command);
        return substr_replace($commandClass, 'Validator', strrpos($commandClass, 'Command'));
    }
}