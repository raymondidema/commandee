<?php namespace Raymondidema\Commandee;

use Illuminate\Support\ServiceProvider;

class CommandeeServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->registerCommandBus();
    }

    protected function registerCommandBus()
    {
        $this->app->bindShared('Raymondidema\Commandee\CommandBus', function () {
            return $this->app->make('Raymondidema\Commandee\ValidationCommandBus');
        });
    }

    public function providers()
    {
        return ['commandee'];
    }
}