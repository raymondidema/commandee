<?php  namespace Raymondidema\Commandee;

interface CommandBus
{
    /**
     * Execute a Command
     *
     * @param $command
     * @return mixed
     */
    public function execute($command);
}