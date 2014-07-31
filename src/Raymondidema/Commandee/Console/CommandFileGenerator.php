<?php namespace Raymondidema\Commandee\Console;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;

class CommandFileGenerator {
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
     * Create a new command instance.
     *
     * @param Filesystem $file
     * @param Mustache_Engine $mustache
     * @param CommandParametersParser $parser
     * @return CommandFileGenerator
     */
    public function __construct(Filesystem $file, Mustache_Engine $mustache, CommandParametersParser $parser)
    {
        $this->file = $file;
        $this->mustache = $mustache;
        $this->parser = $parser;
    }

    /**
     * @param $classPath
     * @param $stub
     * @param $base
     * @param $properties
     * @return string
     */
    public function make($classPath, $stub, $base, $properties)
    {
        // We'll first grab the template to use.
        $stub = $this->file->get($stub);

        // And then parse the command input into something we can use.
        $templateVars = $this->parser->parse($classPath, $properties);

        // And then we'll render the template using this data.
        $stub = $this->mustache->render($stub, $templateVars);

        // And finally write the file to the disk.
        $this->file->put("{$base}/{$classPath}.php", $stub);

        return $stub;
    }
} 