<?php  namespace Raymondidema\Commandee;

interface CommandBus
{
    public function execute($command);
}