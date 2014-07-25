<?php namespace Raymondidema\Commandee;

use ReflectionClass;
use InvalidArgumentException;
use Input, App;

trait CommandeeTrait {

    /**
     * @param       $command
     * @param array $input
     * @param array $decorators
     *
     * @return mixed
     */
    public function execute($command, array $input = null, $decorators = [])
    {
        $input = $input ?: Input::all();
        $command = $this->mapInputToCommand($command, $input);
        $bus = $this->getCommandBus();

        foreach($decorators as $decorator)
        {
            $bus->decorate($decorator);
        }

        return $bus->execute($command);
    }

    /**
     * @return mixed
     */
    public function getCommandBus()
    {
        return App::make('Raymondidema\Commandee\CommandBus');
    }

    /**
     * @param       $command
     * @param array $input
     *
     * @return object
     * @throws \InvalidArgumentException
     */
    protected function mapInputToCommand($command, array $input)
    {
        $dependencies = [];

        $class = new ReflectionClass($command);

        foreach ($class->getConstructor()->getParameters() as $parameter)
        {
            $name = $parameter->getName();

            if (array_key_exists($name, $input))
            {
                $dependencies[] = $input[$name];
            }
            elseif ($parameter->isDefaultValueAvailable())
            {
                $dependencies[] = $parameter->getDefaultValue();
            }
            else
            {
                throw new InvalidArgumentException("Unable to map input to command: {$name}");
            }
        }

        return $class->newInstanceArgs($dependencies);
    }
} 