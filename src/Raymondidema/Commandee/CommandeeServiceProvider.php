<?php namespace Raymondidema\Commandee;

use Illuminate\Support\ServiceProvider;

class CommandeeServiceProvider extends ServiceProvider {

    /**
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service Provider
     */
    public function register()
    {
        $this->registerCommandTranslator();
        $this->registerCommandBus();
    }

    /**
     * Register the Command Bus
     */
    protected function registerCommandBus()
    {
        $this->app->bindShared('Raymondidema\Commandee\CommandBus', function () {
            return $this->app->make('Raymondidema\Commandee\ValidationCommandBus');
        });
    }

    /**
     * Register the command Translator
     */
    public function registerCommandTranslator()
    {
        $this->app->bind(
            'Raymondidema\Commandee\CommandTranslator',
            'Raymondidema\Commandee\BaseCommandTranslator'
        );
    }

    /**
     * @return array
     */
    public function providers()
    {
        return ['commandee'];
    }
}