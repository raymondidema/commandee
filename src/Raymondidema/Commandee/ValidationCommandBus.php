<?php namespace Raymondidema\Commandee;

use Illuminate\Foundation\Application;

class ValidationCommandBus extends BaseCommandBus {

    /**
     * @param $command
     *
     * @return mixed
     */
    public function execute($command)
    {
        $this->validateCommand($command);

        return parent::execute($command);
    }


    /**
     * @param $command
     *
     * @return mixed
     */
    protected function validateCommand($command)
    {
        $validator = $this->commandTranslator->toValidator($command);

        if (class_exists($validator))
        {
            $this->app->make($validator)->validate($command);
        }
    }
} 