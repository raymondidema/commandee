<?php namespace Raymondidema\Commandee;

interface CommandHandler {

    /**
     * @param $command
     *
     * @return mixed
     */
    public function handle($command);
}