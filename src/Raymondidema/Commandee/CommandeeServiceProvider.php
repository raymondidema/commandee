<?php namespace Raymondidema\Commandee;

use Illuminate\Support\ServiceProvider;

class CommandeeServiceProvider extends ServiceProvider {


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $listeners = $this->app['config']->get('commandee.listeners');
        $listenName = $this->app['config']->get('commandee.listenName');
        foreach($listeners as $listener)
        {
            $this->app['events']->listen($listenName, $listener);
        }
    }
}