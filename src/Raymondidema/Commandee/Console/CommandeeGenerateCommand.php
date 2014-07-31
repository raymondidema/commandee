<?php namespace Raymondidema\Commandee\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CommandeeGenerateCommand extends Command {

    /**
     * @var string
     */
    protected $name = 'commandee:generate';

    /**
     * @var string
     */
    protected $description = 'Generate a new command and handler class.';

    /**
     * @var Filesystem
     */
    protected $file;

    /**
     * @var Mustache_Engine
     */
    protected $mustache;

    /**
     * @var CommandParametersParser
     */
    protected $parser;

    /**
     * @var FileGenerator
     */
    private $generator;

    /**
     * @param CommandFileGenerator $generator
     */
    public function __construct(CommandFileGenerator $generator)
    {
        $this->generator = $generator;

        parent::__construct();
    }

    /**
     *
     */
    public function fire()
    {
        $classPath = str_replace('\\', '/', $this->argument('path'));
        $properties = $this->option('properties');
        $base = $this->option('base');

        $commandStub = __DIR__.'/stubs/command.stub';
        $handlerStub = __DIR__.'/stubs/handler.stub';

        // We'll generate Command and CommandHandler classes.
        $this->generator->make($classPath, $commandStub, $base, $properties);
        $this->generator->make($classPath.'Handler', $handlerStub, $base, $properties);

        $this->info('All done! Your two classes have now been generated.');
    }

    /**
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['path', InputArgument::REQUIRED, 'The class path for the command to generate.']
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['properties', null, InputOption::VALUE_OPTIONAL, 'A comma-separated list of properties for the command.', null],
            ['base', null, InputOption::VALUE_OPTIONAL, 'The path to where your domain root is located.', 'app']
        ];
    }
} 