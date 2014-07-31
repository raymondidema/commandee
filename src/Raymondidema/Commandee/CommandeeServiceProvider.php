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
        $this->registerArtisanCommand();
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
     * Register the Artisan command
     *
     * @return void
     */
    public function registerArtisanCommand()
    {
        $this->app->bindShared('commander.command.make', function($app)
        {
            return $app->make('Raymondidema\Commandee\Console\CommandeeGenerateCommand');
        });

        $this->commands('commandee.command.make');
    }

    /**
     * @return array
     */
    public function providers()
    {
        return ['commandee'];
    }
}