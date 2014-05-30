<?php namespace Raymondidema\Commandee\Contracts;

interface CommandHandlerContract {
    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command);
} 