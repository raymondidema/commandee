<?php  namespace Raymondidema\Commandee;

interface CommandTranslator {

    /**
     * @param $command
     *
     * @return mixed
     */
    public function toCommandHandler($command);

    /**
     * @param $command
     *
     * @return mixed
     */
    public function toValidator($command);
} 