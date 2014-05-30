<?php namespace Raymondidema\Commandee\Commanding;

use Acme\Commandee\Exceptions\CommandException;

class CommandTranslator {

    /**
     * @param $command
     *
     * @return mixed
     * @throws \Acme\Commandee\Exceptions\CommandException
     */
    public function toCommandHandler($command)
    {
        $handler = str_replace('Command', 'CommandHandler', get_class($command)); // ...CommandHandler
        if(! class_exists($handler))
        {
            $message = "Command handler [$handler] does not exist.";

            throw new CommandException($message);
        }

        return $handler;
    }

} 